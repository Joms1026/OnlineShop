<?php
require_once("conn.php");
    if($_FILES['gambar']['size'] > 0 && $_FILES['gambar']['error'] == 0){
        // $fileName = $_FILES['gambar']['name'];
        // $mimeType = $_FILES['gambar']['type'];
        $tmpFile = fopen($_FILES['gambar']['tmp_name'], 'rb'); // (fileName, mode)
        $fileData = fread($tmpFile, filesize($_FILES['gambar']['tmp_name']));
        $fileData = addslashes($fileData);
        $query = "update users set display_picture='$fileData' WHERE username ='$_SESSION[userlogin]'";
        mysqli_query($conn,$query);
        header("location:editprofile.php");
    }
    else
    {
        echo "<div style='margin-left:50px;margin-top:20px;width:100px;height:100px;background-color:green'>Error uploading image</div>";
    }
?>