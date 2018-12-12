<?php
require_once "./Workerman-master/Autoloader.php";
require('./vendor/autoload.php');
use Firebase\JWT\JWT;
use Workerman\Worker;

$worker=new Worker('websocket://0.0.0.0:8124');
$worker->count=1;   //设置进程数

//连接数据库
try{
    $pdo = new PDO('mysql:host=localhost;dbname=chat_room','root','');
    $pdo->exec("set names utf8");
    echo '数据库连接成功';
}catch(PDOException $e){
    echo "数据库连接失败!".$e->getMessage();
}

// 保存所有的房间  room_id作为下标
$rooms=[
            // [
            //     'room_name'=>'全栈一组',    //房间名
            //     'room_users'=>[            //该房间里的用户,user_id作为下标
            //         '1'=>'张三',
            //         '2'=>'李四'
            //     ]
            // ]
        ];
//从数据库中初始化房间信息
try{
    $sql = "select * from rooms";
    $stmt = $pdo->query($sql);
    $room_list=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($room_list as $v){
        $rooms[$v['id']]=[
            'room_name'=>$v['room_name'],
            'room_users'=>[]
        ];
    }
}catch(PDOException $e){
    echo "数据库操作失败!".$e->getMessage();
}

//保存所有在线用户       
$users=[
    'user_name'=>[],    //保存在线用户的用户名 下标为用户id
    'connection'=>[]    //保存在线用户所在的客户端对象 下标为用户id
];


//客户端连接成功时
$worker->onConnect=function($connection){

    $connection->onWebSocketConnect = function ($connection, $http_header) {
        global $rooms,$users,$pdo;
        try{
            $key='abcd';
            $token = JWT::decode($_GET['token'], $key, array('HS256'));

            // 给当前客户端对象设置信息
            $connection->user_id=$token->user_id;
            $connection->user_name=$token->user_name;

            //将当前用户信息保存到数组中
            $users['user_name'][$token->user_id]=$token->user_name;
            $users['connection'][$token->user_id]=$connection;
            //取出大厅的聊天记录
            try{
                $sql = "select * from messages where chat_type='all'";
                $stmt = $pdo->query($sql);
                $all_msg=$stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "数据库操作失败!".$e->getMessage();
            }
            //给所有在线的客户端推送新上线的用户
            foreach($users['connection'] as $c){

                $arr=[
                        'type'=>"update_status",
                        'users'=>$users['user_name'],
                        'rooms'=>$rooms,
                        'all_msg'=>$all_msg,
                        'user_name'=>$connection->user_name
                    ];
                
                $c->send(json_encode($arr));

            }
            
        }catch(\Firebase\JWT\ExpiredException $e){
            $connection->close();
        }catch(\Exception $e){
            $connection->close();
        }
    };
};

//客户端发送信息时
$worker->onMessage=function($connection,$data){
    global $rooms,$users,$pdo;
    //得到客户端发送的数据
    $info=json_decode($data);
    
    switch($info->chat_type){
        case 'join_all':
        //用户进入大厅时
            //取出大厅的聊天记录
            try{
                $sql = "select * from messages where chat_type='all'";
                $stmt = $pdo->query($sql);
                $all_msg=$stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "数据库操作失败!".$e->getMessage();
            }
            $arr=[
                'type'=>"join_all",
                'all_msg'=>$all_msg
            ];
            $connection->send(json_encode($arr));
            break;
        case 'all':
        //当用户在大厅发消息时
            //把信息作为聊天记录添加到数据库
            try{
                $sql = "insert into messages 
                        (content,chat_type,user_id,user_name)
                         values 
                        ('{$info->content}','all',{$connection->user_id},'{$connection->user_name}')";
                $stmt = $pdo->exec($sql);
                // echo $sql;
            }catch(PDOException $e){
                echo "数据库操作失败!".$e->getMessage();
            }
            foreach($users['connection'] as  $c){
                $arr=[
                    'type'=>"sub_all",
                    'content'=>$info->content,
                    'user_name'=>$connection->user_name
                ];
                $c->send(json_encode($arr));
            }
            break;

        case 'join_room':
        //用户进入某房间时
            //先退出之前进入的房间
            if(isset($connection->room_id)){
                unset($rooms[$connection->room_id]['room_users'][$connection->user_id]);
            }
            //再重新更新房间信息
            $connection->room_id=$info->room_id;
            $rooms[$info->room_id]['room_users'][$connection->user_id]=$connection->user_name;
            //取出该房间的聊天记录
            try{
                $sql = "select * from messages where room_id={$info->room_id}";
                $stmt = $pdo->query($sql);
                $room_msg=$stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "数据库操作失败!".$e->getMessage();
            }
            //推送信息,更新前台显示状态
            foreach($users['connection'] as $c){
                $arr=[
                        'type'=>"join_room",
                        'room_msg'=>$room_msg,
                        'rooms'=>$rooms,
                        'user_name'=>$connection->user_name
                    ];
                $c->send(json_encode($arr));
            }
            break;

        case 'room':
        //用户在房间发布信息时
            //把信息作为聊天记录添加到数据库
            try{
                $sql = "insert into messages 
                        (content,chat_type,room_id,room_name,user_id,user_name)
                         values 
                        ('{$info->content}','room',{$info->room_id},'{$info->room_name}',{$connection->user_id},'{$connection->user_name}')";
                $stmt = $pdo->exec($sql);
                // echo $sql;
            }catch(PDOException $e){
                echo "数据库操作失败!".$e->getMessage();
            }
            //给在这个房间的人推送信息
            foreach($rooms[$info->room_id]['room_users'] as  $k=>$c){
                $arr=[
                    'type'=>"sub_room",
                    'content'=>$info->content,
                    'user_name'=>$connection->user_name
                ];
                $users['connection'][$k]->send(json_encode($arr));

            }
            break;

        case 'join_one':
        //用户进入私聊模式时
            //取出该私聊的聊天记录
            try{
                $sql = "select * from messages where (one_id={$info->one_id} and user_id={$connection->user_id}) or (one_id={$connection->user_id} and user_id={$info->one_id})";
                $stmt = $pdo->query($sql);
                $one_msg=$stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "数据库操作失败!".$e->getMessage();
            }
            $arr=[
                'type'=>"join_one",
                'one_msg'=>$one_msg,
                'user_name'=>$connection->user_name
            ];
            $connection->send(json_encode($arr));
            break;
        
        case 'one':
        //私聊发信息时
            //把信息作为聊天记录添加到数据库
            try{
                $sql = "insert into messages 
                        (content,chat_type,one_id,one_name,user_id,user_name)
                         values 
                        ('{$info->content}','one',{$info->one_id},'{$info->one_name}',{$connection->user_id},'{$connection->user_name}')";
                $stmt = $pdo->exec($sql);
                // echo $sql;
            }catch(PDOException $e){
                echo "数据库操作失败!".$e->getMessage();
            }   
            $arr=[
                'type'=>"sub_one",
                'content'=>$info->content,
                'user_name'=>$connection->user_name
            ];
            //给对方推送信息
            $users['connection'][$info->one_id]->send(json_encode($arr));
            //给自己推送信息
            $users['connection'][$connection->user_id]->send(json_encode($arr));
            break;

    }
    
};

//客户端断开连接时
$worker->onClose=function($connection){
    global $rooms,$users;

    //退出大厅,清除该用户
    unset($users['user_name'][$connection->user_id]);
    unset($users['connection'][$connection->user_id]);

    //退出房间，将用户从房间中踢出
    if(isset($connection->room_id)){
        unset($rooms[$connection->room_id]['room_users'][$connection->user_id]);
    }

    //退出房间时，给所有人推送离开信息
    foreach($users['connection'] as $c){
        $arr=[
                'type'=>"close",
                'users'=>$users['user_name'],
                'rooms'=>$rooms,
                'user_name'=>$connection->user_name
            ];
        
        $c->send(json_encode($arr));
    }
};

//启动服务
Worker::runAll();