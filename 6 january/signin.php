<?php include('conn.php'); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $msg="";
    $login="";
    if(isset($_REQUEST["btnsubmit"])){
        $name=$_REQUEST["loginname"];
        $password=$_REQUEST["loginpassword"];
        if(empty($name) || empty($password)){
            $msg = "plz enter details";
        }
        else{
        $sql = "select * from admin where Name='$name' and password='$password'";
        $result = mysqli_query($conn,$sql);
        $recordfound = mysqli_num_rows($result);

        if($recordfound){
            $row = mysqli_fetch_assoc($result);
            $_SESSION["adminid"] = $row["AdminId"];
            $_SESSION["name"] = $row["Name"];
            header("location:adminhome.php");
        }
        else{
            $msg="invalid login/password";
        }
    }
    }
    ?>
    <form action="" method="POST">
        Login : <input type="text" name="loginname" value="<?php $login ?>"><br>
        Pasword : <input type="password" name="loginpassword"><br>
        <input type="submit" value="Login" name="btnsubmit"><br>
        <a href="signup.php">Sign Up</a>
        <span style="color: red;"><?php echo $msg;?></span>
    </form>
</body>
</html>