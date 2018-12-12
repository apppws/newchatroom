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
if(isset($_GET['id'])){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=chat_room','root','');
        $pdo->exec("set names utf8");
        $sql = "select * from user where id={$_GET['id']}";
        $stmt = $pdo->query($sql);
        if($stmt->rowCount()>0){
            $user=$stmt->fetch(PDO::FETCH_ASSOC);
        }else {
            echo "<script>alert('请求数据有误');location.href='./index.php';</script>";
            exit;
        }
    }catch(PDOException $e){
        echo "数据库连接失败!".$e->getMessage();
        exit();
    }
}else{
    echo "<script>alert('非法请求');location.href='./index.php';</script>";
    exit;
}
if(isset($_POST['username'])){
    if($_POST['username']!='' && $_POST['password']!=''&&$_POST['phone']!=''){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $phone=$_POST['phone'];
        $sql="update user set username='{$username}',password='{$password}',phone='{$phone}' where id={$user['id']}";
        $stmt=$pdo->exec($sql);
        if($stmt){
            echo "<script>alert('修改成功');location.href='./index.php';</script>";
        }else{
            echo "<script>alert('修改失败');</script>";
        }
    }else{
        echo "<script>alert('用户名，密码，手机号不能为空')</script>";
    }
        
}

 ?>
<body>
    <div class="box">
        <h1>修改</h1>
        <form action="" method="post">

            用户名：<input type="text" name="username" value="<?php echo $user['username']; ?>">
            <br>
            密 &nbsp; 码：<input type="text" name="password" value="<?php echo $user['password']; ?>">
            <br>
            手机号：<input type="text" name="phone" value="<?php echo $user['phone']; ?>">
            <br>
            <input type="submit" value="修 改">
            <br>

        </form>
    </div>
    
</body>
</html>