<?php include('conn.php'); ?>
<?php include("validatesession.php"); ?>

<?php
if(isset($_REQUEST["pid"]) && $_REQUEST["pid"]>0){
    $pid = $_REQUEST["pid"];
    $sql = "update product set IsActive=0 where ProductId=$pid and IsActive=1";
    $result=mysqli_query($conn,$sql);

    header("location:viewproducts.php");
}
else{
    header("location:adminhome.php");
}
?>