<?php
 $servername= "localhost";
 $username="root";
 $password="";
 $dbname="assignment";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die("connection fialed : ".mysqli_connect_error());
    }
?>