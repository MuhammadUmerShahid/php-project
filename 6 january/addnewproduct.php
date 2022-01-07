<?php include('conn.php'); ?>
<?php include("validatesession.php"); ?>
<?php include("fileapi.php"); ?>

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
        $price = $_REQUEST["price"];
        $type = $_REQUEST["type"];
        $des = $_REQUEST["description"];

        $file = $_FILES["productimg"];
        $src_path=$file["tmp_name"];
        $filename=$file["name"];

        $new_name = savefile($src_path,$filename);
        date_default_timezone_set("Asia/karachi");
        $updated_on=date('d-m-y H:i:s');
        $updated_by = $_SESSION["name"];
        $sql = "INSERT INTO product (Name,Price,TypeId,Description,PicURL,UpdatedOn,UpdatedBy,IsActive)
         VALUES('$name','$price','$type','$des','$new_name','$updated_on','$updated_by',1)";
         if(mysqli_query($conn,$sql)){
            $msg="Product Is Created Successfully!";
         }
         else{
            // $msg="Unable to Create, Try Again!";
             $msg="Error : ".$sql." ".mysqli_error($conn);
         }
    }


    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        Name : <input type="text" name="name"><br>
        Price : <input type="text" name="price"><br>
        Type Select : <select name="type" id="">
            <?php
            $sql = "SELECT * FROM type";
            $result = mysqli_query($conn,$sql);
            $recordfound = mysqli_num_rows($result);
            if($recordfound>0){
               while($row = mysqli_fetch_assoc($result)){
                $id = $row["TypeId"];
                $name = $row["TypeName"];
                echo"<option value='$id'>$name</option>";
               }
            }
            ?>
        </select><br>
        Description : <br>
        <textarea name="description" id="" cols="30" rows="10"></textarea><br>
        Picture : <br>
        <input type="file" name="productimg"><br><br>
        <input type="submit" value="Create" name="btnsubmit">
        <a href="adminhome.php">Back</a>
        <span style="color: red;"><?php echo $msg;?></span>
    </form>
</body>
</html>  