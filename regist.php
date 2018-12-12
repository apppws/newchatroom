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
            margin-left: 80px;
        }
    </style>
</head>
<?php 
if(isset($_POST['username'])){
    if($_POST['username']!='' && $_POST['password']!=''&&$_POST['phone']!=''){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $phone=$_POST['phone'];
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=chat_room','root','');
            $pdo->exec("set names utf8");

            $sql = "select * from user where username='{$username}'";
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()>0){
                echo "<script>alert('用户名已存在，请重新注册');location.href='./regist.php';</script>";
                exit();
            }
            $sql = "insert into user values(null,'{$username}','{$password}','{$phone}')";
            $num = $pdo->exec($sql);
            if($num!=false){
                echo "<script>alert('注册成功');location.href='./login.php';</script>";
            }else {
                echo "<script>alert('注册失败')</script>";
                exit();
            }
        }catch(PDOException $e){
            echo "数据库连接失败!".$e->getMessage();
            exit();
        }
    }else{
        echo "<script>alert('用户名，密码，手机号不能为空')</script>";
    }
        
}

 ?>
<body>
    <div class="box">
        <h1>注册</h1>
        <form action="" method="post">

            用户名：<input type="text" name="username">
            <br>
            密 &nbsp; 码：<input type="password" name="password" id="">
            <br>
            手机号：<input type="text" name="phone">
            <br>
            <input type="submit" value="注  册">
            <br>
            <a href="./login.php">去登录</a>

        </form>
    </div>
    
</body>
</html>