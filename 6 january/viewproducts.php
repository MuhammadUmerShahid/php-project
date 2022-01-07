<? session_start(); ?>
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
    $sql = "SELECT * FROM product where IsActive=1";
    $result = mysqli_query($conn,$sql);
    $recordfound = mysqli_num_rows($result);

    if($recordfound>0)
    {
        while($rows=mysqli_fetch_assoc($result))
        {
            $productid=$rows["ProductId"];
            $picurl=$rows["PicURL"];
            $name=$rows["Name"];
            $price=$rows["Price"];
            $typeid=$rows["TypeId"];

            $nn="select TypeName from type where TypeId=$typeid";
            $r=mysqli_query($conn,$nn);
            $record=mysqli_num_rows($r);
            if($record>0){
               $row= mysqli_fetch_assoc($r);
               $n=$row["TypeName"];
            }

            $description=$rows["Description"];
            $updatedon=$rows["UpdatedOn"];
            $updatedby=$rows["UpdatedBy"];

            // $adminname="select Name from admin where AdminId=$updatedby";
            // $adminR=mysqli_query($conn,$adminname);
            // $adminrecord=mysqli_num_rows($adminR);
            // if($adminrecord>0){
            //    $row1= mysqli_fetch_assoc($adminR);
            //    $adminname1=$row1["Name"];
            // }


            echo "<div>";
            echo "<img src='img/$picurl' style='width: 50px; height: 50px;'/><br>";
            echo"<h2>$name</h2>";
            echo"Type : $n<br>";
            echo"Price : $price<br>";
            echo"Description : $description<br>";
        //    echo"Updated By : $adminname1<br>";
            echo"Updated By : $updatedby<br>";
            echo"Updated On : $updatedon<br>";

          //  if(isset($_SESSION["adminid"])){
                echo"<a href='deleteproduct.php?pid=$productid'>Delete</a><br>";
                echo"<a href='editproduct.php?pid=$productid'>Edit</a>";
         //   }
            echo"</div>";
        
        }
    }

    ?>
    <a href="adminhome.php">Back</a>
</body>
</html>