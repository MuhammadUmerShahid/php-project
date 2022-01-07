<?php
session_start();
$_SESSION["adminid"];
$_SESSION["name"];
session_destroy();
header("location:signin.php");
?>