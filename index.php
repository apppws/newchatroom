<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .box{
            width: 500px;
            margin:0px auto;
            padding:20px;
        }
        table{
            width:100%;
        }
        h2{
            float:left;
        }
        h3{
            float:right;
        }
    </style>
</head>
<?php 
    require('./vendor/autoload.php');
    use Firebase\JWT\JWT;
    $key='abcd';
    if(isset($_COOKIE['jwt_token'])){
        $data = JWT::decode($_COOKIE['jwt_token'], $key, array('HS256'));
    }
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=chat_room','root','');
        $pdo->exec("set names utf8");
        $sql = "select * from user";
        $stmt = $pdo->query($sql);
        if($stmt->rowCount()>0){
            $users=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }else {
            $users=[];
        }
    }catch(PDOException $e){
        echo "数据库连接失败!".$e->getMessage();
        exit();
    }

    if(isset($_GET['id'])){
        $pdo = new PDO('mysql:host=localhost;dbname=chat_room','root','');
        $pdo->exec("set names utf8");
        $sql = "delete from user where id={$_GET['id']}";
        $stmt = $pdo->exec($sql);
        if($stmt){
            echo "<script>alert('删除成功');location.href='./index.php'</script>";
        }else{
            echo "<script>alert('登录失败');location.href='./index.php'</script>";
        }
    }
    
 ?>
<body>
    <div class="box">
        <div>
            <h2>已注册用户列表</h2>
            
            <?php if(!isset($data->user_id)):?>
                <h3><span style="color:red">[登录后可进入聊天室]</span></h3>
                <h3><a href="./regist.php">注册</a> | </h3>
                <h3><a href="./login.php">登录</a> | </h3>
            <?php else:?>
                <h3><a href="./chat.php">进入聊天室</a></h3>
                <h3><a href="./logout.php">退出登录</a> | </h3>
                <h3> <span style="color:red;"><?php echo isset($data->user_name)?$data->user_name:''; ?></span> | </h3>
            <?php endif;?>
        </div>
        <table border="1">
            <tr>
                <th>序号</th>
                <th>用户名</th>
                <?php if(isset($data->user_name)&&$data->user_name=='root'): ?>
                    <th>电话</th>
                    <th>操作</th>
                <?php endif;?>
            </tr>
            <?php foreach($users as $v): ?>
            <tr>
                <td><?php echo $v['id']; ?></td>
                <td><?php echo $v['username']; ?></td>
                <?php if(isset($data->user_name)&&$data->user_name=='root'): ?>
                    <td><?php echo $v['phone']; ?></td>
                    <td>
                        <a href="./edit.php?id=<?php echo $v['id']; ?>">修改</a> | 
                        <a href="?id=<?php echo $v['id']; ?>">删除</a>
                    </td>
                <?php endif;?>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</body>
</html>