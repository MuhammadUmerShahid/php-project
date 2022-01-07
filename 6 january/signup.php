<?php include('conn.php'); ?>

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
    $msg = "";
    if(isset($_REQUEST["btnsubmit"])){
        $name = $_REQUEST["name"];
        $login = $_REQUEST["login"];
        $password = $_REQUEST["password"];
        if(empty($name) || empty($login) || empty($password)){
            $msg = "plz enter details";
        }
        else{

        $sql = "INSERT INTO admin (Name,Login,Password) VALUES ('$name','$login','$password')";
        if(mysqli_query($conn,$sql)){
            $msg = "Account is Created Successfully!";
        }
        else{
            $msg = "Unable to Create Account, Try Again!";
            $msg = "Error : ".$sql." ".mysqli_error($conn);
        }
    }
    }
?>

    <form action="" method="POST">
        Name : <input type="text" name="name"><br>
        Login : <input type="text" name="login"><br>
        Password : <input type="password" name="password"><br>
        <input type="submit" value="Sign Up" name="btnsubmit"><br>
        <a href="signin.php">Sign In</a><br><br>
        <span style="color: red;"><?php echo $msg;?></span>
    </form>
</body>
</html>