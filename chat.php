<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
/* 公共样式 */
        *{
            margin: 0;
            padding: 0;
        }
        ul,li{
            list-style: none;
        }
        .box{
            width: 80%;
            border:1px solid #666;
            margin:0px auto;
        }
        h1{
            text-align: center;
            margin:0px auto;
        }
        
        .content{
            width: 100%;
            height: 450px;
            border-top:1px solid #666;
            border-bottom:1px solid #666;
        }
/* 所有在线联系人 */
        .link_all{
            float: left;
            width: 25%;
            height: 100%;
            text-align: center;
            overflow:auto
        }
        .link_all h3{
            margin:20px 0px;
            color:green;
        }
        .link_all li{
            margin-bottom:10px;
        }
/* 群聊内容 */
        .msg{
            float: left;
            width: 45%;
            height:90%;
            border-left:1px solid #666;
            border-right:1px solid #666;
            padding:20px;
            position: relative;
            overflow-y:scroll;
        }
        .msg .msg_box{
            width: 100%;
            display: inline-block;            
        }
        .msg ul{
            width:100%;
            min-height:45px;      
            margin:10px 0px;  
            border:1px solid #fff; 
        }
        .msg ul li{
            clear:both;
            margin-bottom:20px;
        }
        .msg li h4{
            display:inline-block;
            margin-right:10px;
        }
        .msg li span{
            display:inline-block;
            max-width:70%;
            padding:10px;
            border:1px solid #ccc;
            background-color:skyblue;
            border-radius:15px;
        }
        
        .msg .left,.msg .left h4{
            float:left;
        }
        
        .msg .right,.msg .right h4,.msg .right span{
            float:right;
        }
        .msg .right h4{
            margin-left:10px;
        }
/* 房间在线联系人 */
        .link_room{
            float: left;
            height: 80%;
            width: 25%;
            padding-top: 20px;
            overflow:auto;
        }
        .link_room h3{
            text-align: center;
            margin-bottom:20px;
            color:green;
        }
        .room{
            width:100%;
        }
        .room .join{
            margin-left:10px;
            padding:2px;
        }
        .link_room .group{
            width: 70%;
            overflow: hidden;
            margin:0px auto;
            top: 0;
            background-color: #ccc;
            border: 1px solid #999;
            margin-bottom: 10px;
        }
        .link_room .group li{
            cursor: pointer;
            height: 22px;
            border:2px solid #ccc;
            background-color: greenyellow;
            padding-left: 20px;
        }
        .link_room .group li:first-child{
            padding-left: 0;
            background-color: #ccc;
        }
        .link_room .group li a{
            color:red;
        }
        .group_height{
            height: 22px;
        }
        
        /* 底部发送信息 */
        .bottom{
            width: 100%;
        }
        .bottom div{
            width: 40%;
            margin:20px auto;
        }
        .bottom textarea{
            width: 70%;
            height:50px;
            resize:vertical;
        }
        input[type="submit"]{
            float:right;
            width: 20%;
            height: 50px;
        }
        
    </style>
</head>

<body>
<div id="vue">
    <div class="box">
        <h1>
            <span style="color:yellowgreen;" v-if="chat_type=='all'">【广场群聊】</span>
            <span style="color:yellowgreen;" v-if="chat_type=='room'">【{{room_name}}】</span>
            <span style="color:yellowgreen;" v-if="chat_type=='one'">【{{one_name}}】</span>

            <span v-if="chat_type!='all'"><a href="javascript:;" @click.prevent="join_all">进入广场聊天</a></span>
            <span><a href="/" style="color:red;">退出聊天室</a></span>
        </h1>
        <div class="content">
            <div class="link_all">
                <h3>其它在线联系人</h3>
                <ul class="">
                    <li v-for="(v,k) in users" v-if="v!=user_name">{{v}} : <a href="javascript:;" @click.prevent="join_one(k,v)" >点击私聊</a></li>
                </ul>
            </div>

        <!-- 聊天内容s -->
            
            <!-- 广场聊天内容 -->
            <div class="msg" v-if="chat_type=='all'">
                <div class="msg_box">
                    <ul v-for="(v,k) in all_msg">
                        <li class="left" v-if="v.user_name!=user_name">
                            <h4>{{v.user_name}} :</h4><span>{{v.content}}</span>
                        </li>
                        <li class="right" v-if="v.user_name==user_name">
                            <h4>: {{v.user_name}}</h4><span>{{v.content}}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 房间聊天内容 -->
            <div class="msg" v-if="chat_type=='room'">
                <div class="msg_box">
                <ul v-for="(v,k) in room_msg">
                    <li class="left" v-if="v.user_name!=user_name">
                        <h4>{{v.user_name}} :</h4><span>{{v.content}}</span>
                    </li>
                    <li class="right" v-if="v.user_name==user_name">
                        <h4>: {{v.user_name}}</h4><span>{{v.content}}</span>
                    </li>
                </ul>
                </div>
            </div>

            <!-- 私聊内容 -->
            <div class="msg" v-if="chat_type=='one'">
                <div class="msg_box">
                <ul v-for="(v,k) in one_msg">
                    <li class="left" v-if="v.user_name!=user_name">
                        <h4>{{v.user_name}} :</h4><span>{{v.content}}</span>
                    </li>
                    <li class="right" v-if="v.user_name==user_name">
                        <h4>: {{v.user_name}}</h4><span>{{v.content}}</span>
                    </li>
                </ul>
                </div>
            </div>
        <!-- 聊天内容e -->

            <div class="link_room">
                <h3>房间群聊</h3>
                <div class="room">
                    <ul class="group group_height"  v-for="(v,k) in rooms"> 
                        <li>
                            <span>▼</span>{{v.room_name}} 
                            <button class="join" style="float:right;" v-if="v.room_name!=room_name">
                                <a href="javascript:;" @click.prevent="join_room(k,v.room_name)" >进入房间</a>
                            </button>
                        </li>
                        <li v-for="(v1,k1) in v.room_users">{{v1}} 
                            <a href="javascript:;" style="float:right;" @click.prevent="join_one(k1,v1)" v-if="v1!=user_name">点击私聊</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div>
                <textarea cols="30" rows="10" v-model="content"></textarea>
                <input type="submit" value="点击发送" @click.prevent="submit">
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="js/jquery.min.js"></script>
<script src="js/vue.min.js"></script>
<?php
    require('./vendor/autoload.php');
    use Firebase\JWT\JWT;
    if(isset($_COOKIE['jwt_token'])){
        $key='abcd';
        $jwt_token=$_COOKIE['jwt_token'];
        $token = JWT::decode($_COOKIE['jwt_token'], $key, array('HS256'));
        $user_name=$token->user_name;
    }else{
        $jwt_token='';
    }
?>

<script>
    new Vue({
        el:'#vue',
        data:{
            ws:null,                //workerman客户端对象
            user_name:'',           //保存自己的用户名
            rooms:[],           //保存所有房间
            users:[],           //保存所有在线用户
            
            room_id:null,           //保存当前进入的房间id
            room_name:null,         //保存当前进入的房间名
            one_id:null,            //保存当前私聊对象id
            one_name:null,          //保存当前私聊对象name

            all_msg:[],             //保存大厅聊天信息
            room_msg:[],            //保存房间聊天信息
            one_msg:[],             //保存私人聊天信息
            
            chat_type:'all',        //保存当前聊天的方式  all:广场群聊   room:房间群聊  one:私聊
            content:'',             //保存即将发送的消息
            
        },
        created:function(){

            var jwt_token="<?=$jwt_token?>";
            
            if(jwt_token!=''){  //判断是否登录,登录后初始化数据
                this.ws=new WebSocket("ws://127.0.0.1:8124?token="+jwt_token);
                this.ws.onopen=this.onopen;
                this.ws.onmessage=this.onmessage;
                this.ws.onclose=this.onclose;
                
                this.user_name="<?=$user_name?>";

            }else{
                alert('请先登录!');
                location.href="login.php";
            }
            //房间下拉列表
            $('.group li:first-child').on('click',function(){
                $(this).parent().toggleClass('group_height');
            })
            //信息添加时自动向上移动效果
            let msg_box_height=$('.msg_box').height();
            $('.msg').scrollTop(msg_box_height);
        },
        updated:function(){
            //房间下拉列表
            $('.group li:first-child').on('click',function(){
                $(this).parent().toggleClass('group_height');
            });
            this.user_name="<?=$user_name?>";

            //信息添加时自动向上移动效果
            let msg_box_height=$('.msg_box').height();
            $('.msg').scrollTop(msg_box_height);

        },
        methods:{
            onopen:function(){
                alert('o(*￣3￣)o  欢迎来到《你的明天更美好》聊天室 o(￣ε￣*)o ');
            },
            onmessage:function(e){
                var data=JSON.parse(e.data);

                //判断当前在聊天室中的状态，执行相应的操作
                switch(data.type){
                    case 'update_status':
                        //进入聊天室
                        this.users=data.users;
                        this.rooms=data.rooms;
                        if(this.user_name==data.user_name){
                            this.all_msg=data.all_msg;
                        }
                        this.all_msg=data.all_msg;
                        // console.log(data.user_name+'进入聊天室!!!');
                        break;
                    case 'close':
                        //离开聊天室
                        this.users=data.users;
                        this.rooms=data.rooms;
                        // console.log(data.user_name+'离开聊天室!!!');
                        break;
                    case 'join_all':
                        //进入大厅时（跟首次进入聊天室不同）
                        this.all_msg=data.all_msg;
                        break;
                    case 'sub_all':
                        //在广场发消息
                        this.all_msg.push({
                            'user_name':data.user_name,
                            'content':data.content
                        });
                        // console.log(this.all_msg);
                        break;
                    case 'join_room':
                        //进入某个房间
                        this.rooms=data.rooms;
                        if(this.user_name==data.user_name){
                            this.room_msg=data.room_msg;
                        }
                        break;
                    case 'sub_room':
                        //在房间发消息
                        this.room_msg.push({
                            'user_name':data.user_name,
                            'content':data.content
                        });
                        break;
                    case 'join_one':
                        //进入私聊模式
                        this.one_msg=data.one_msg;
                        break;
                    case 'sub_one':
                        //私聊发消息
                        this.one_msg.push({
                            'user_name':data.user_name,
                            'content':data.content
                        });
                        break;
                }

            },
            onclose:function(){
                
            },
            submit:function(){

                let sub_obj=null;
                if(this.chat_type=='all'){
                    sub_obj={chat_type:'all',content:this.content};
                }else if(this.chat_type=="room"){
                    sub_obj={chat_type:'room',room_id:this.room_id,room_name:this.room_name,content:this.content};
                }else if(this.chat_type=="one"){
                    sub_obj={chat_type:'one',one_id:this.one_id,one_name:this.one_name,content:this.content};
                }

                this.content='';
                this.ws.send(JSON.stringify(sub_obj));
            },
            join_all:function(){
                //用户进入大厅时触发
                this.chat_type='all';
            },
            join_room:function(room_id,room_name){

                //用户进入房间时触发,对相关显示信息进行重置
                this.chat_type='room';
                this.room_id=room_id;
                this.room_name=room_name;

                let sub_obj={chat_type:'join_room',room_id:this.room_id,room_name:this.room_name};
                this.ws.send(JSON.stringify(sub_obj));

            },
            join_one:function(one_id,one_name){

                //用户进入私聊模式时触发,对相关显示信息进行重置
                this.chat_type='one';
                this.one_id=one_id;
                this.one_name=one_name;

                let sub_obj={chat_type:'join_one',one_id:this.one_id,one_name:this.one_name};
                this.ws.send(JSON.stringify(sub_obj));
            }
        }
    })
</script>