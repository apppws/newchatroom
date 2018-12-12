<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .box{
            width: 400px;
            height: 300px;
            border:1px solid #ccc;
            margin:50px auto;
        }
        .box h1{
            text-align: center;
        }
        form{
            padding-left: 80px;
        }
        form input{
            margin-bottom: 20px;
        }
        input[type="submit"]{
            width: 100px;
            height: 30px;
            margin-left: 20px;
        }
    </style>
</head>
<?php 
require('./vendor/autoload.php');
use Firebase\JWT\JWT;

if(isset($_POST['username'])){
    if($_POST['username']!='' && $_POST['password']!=''){
        $username=$_POST['username'];
        $password=$_POST['password'];
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=chat_room','root','');
            $pdo->exec("set names utf8");
            $sql = "select * from user where username='{$username}' and password='{$password}'";
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()>0){
                $user=$stmt->fetch(PDO::FETCH_ASSOC);
                $key="abcd";
                $token = array(
                    'user_id'=>$user['id'],
                    'user_name'=>$user['username']
                );
                $jwt=JWT::encode($token,$key);
                if(isset($_POST['agree'])){
                    setcookie("jwt_token", $jwt,time()+3600);
                }else{
                    setcookie("jwt_token", $jwt); 
                }
                echo "<script>alert('登录成功');location.href='./index.php'</script>";
            }else {
               echo "<script>alert('用户名或密码输入错误')</script>";
            }
        }catch(PDOException $e){
            echo "数据库连接失败!".$e->getMessage();
            exit();
        }
    }else{
        echo "<script>alert('用户名或密码不能为空')</script>";
    }
        
}

 ?>
<body>
    <div class="box">
        <h1>登录</h1>
        <form action="" method="post">
            用户名：<input type="text" name="username">
            <br>
            密 &nbsp; 码：<input type="password" name="password">
            <br>
            <br>
            <input type="checkbox" name="agree">记住密码【7天有效】
            <input type="submit" value="登  录">
            <br>
            <a href="./regist.php">去注册</a>
        </form>
    </div>
    
</body>
</html>