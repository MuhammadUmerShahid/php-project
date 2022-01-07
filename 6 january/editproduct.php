<?php include('conn.php'); ?>
<?php include("validatesession.php"); ?>
<?php include("fileapi.php"); ?>

<?php
$msg = "";
$productid = "";
$name = "";
if(isset($_REQUEST["pid"]) && $_REQUEST["pid"]>0){
    $pid = $_REQUEST["pid"];
    $sql = "select * from product where ProductId=$pid and IsActive=1";
    $result=mysqli_query($conn,$sql);
    $recordfound = mysqli_num_rows($result);
    if($recordfound){
        $rows = mysqli_fetch_assoc($result);

        $productid=$rows["ProductId"];
        $picurl=$rows["PicURL"];
        $name=$rows["Name"];
        $price=$rows["Price"];
        $typeid=$rows["TypeId"];
        $description=$rows["Description"];
        $updatedon=$rows["UpdatedOn"];
        $updatedby=$rows["UpdatedBy"];
    }
    else{
        header("location:adminhome.php");
    }
}
else{
    header("location:adminhome.php");
}

if(isset($_REQUEST["btnsubmit"])){
        $pid = $_REQUEST["productid"];
        $name = $_REQUEST["name"];
        $price = $_REQUEST["price"];
        $type = $_REQUEST["type"];
        $des = $_REQUEST["description"];
        $new_name = "";

    if(isset($_FILES["productimg"]) && !empty($_FILES["productimg"]["name"])){
        $file = $_FILES["productimg"];
        $src_path=$file["tmp_name"];
        $filename=$file["name"];
        $new_name = savefile($src_path,$filename);
    }
    $partial_query = "";
    if(!empty($new_name)){
        $partial_query = ",picurl='$new_name'";
    }
        $updated_on=date('d-m-y H:i:s');
        $updated_by = $_SESSION["adminid"];
    $sql = "Update product SET Name='$name',Price='$price',TypeId='$ype',
    Description='$des'".$partial_query.",UpdatedOn='$updated_on',UpdatedBy='$updated_by' where ProductId=$pid";
    if(mysqli_query($conn,$sql)){
        header("location:viewproducts.php");
    }
    else{
        $msg="Unable to create, try again";
        $msg="Error : ".$sql." ".mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="productid" value="<?php echo $productid; ?>">
        Name : <input type="text" name="name" value="<?php echo $name; ?>"><br>
        Price : <input type="text" name="price" value="<?php echo $price; ?>"><br>
        Type Select : <select name="type" id="">
            <?php
            $sql = "SELECT * FROM type";
            $result = mysqli_query($conn,$sql);
            $recordfound = mysqli_num_rows($result);
            if($recordfound>0){
               while($row = mysqli_fetch_assoc($result)){
                $id = $row["TypeId"];
                $name = $row["TypeName"];
                if($id==$typeid){
                echo"<option value='$id' selected>$name</option>";
               }
               else{
                echo"<option value='$id'>$name</option>";
               }
            }
        }
            ?>
        </select><br>
        Description : <br>
        <textarea name="description" id="" cols="30" rows="10"><?php echo $description;?></textarea><br>
        Picture : <br>
        <img src="img/<?php echo $picurl; ?>" style="width: 50px; height=50px"><br>
        <input type="file" name="productimg"><br><br>
        <input type="submit" value="Update" name="btnsubmit">
        <a href="viewproducts.php">Back</a>
        <span style="color: red;"><?php echo $msg;?></span>
    </form>
</body>
</html>