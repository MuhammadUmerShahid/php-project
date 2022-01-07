<?php
function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function savefile($src_path,$name){


  $new_name = GUID();
 // echo"Name : ".$new_name;
 // echo"<br>";

  $temparr= explode(".",$name);
 // print_r($temparr);
 // echo"<br>";
  $ext = end($temparr);

 // echo "Extension : ".$ext;
 // echo"<br>";
  $full_new_name= $new_name.".".$ext;
    $des_path = "img//".$full_new_name;

    move_uploaded_file($src_path,$des_path);

   // move_uploaded_file($src_path,$des_path);
//     echo $age;
//     echo "<br>";
//     print_r($file);
    return $full_new_name;
}
?>