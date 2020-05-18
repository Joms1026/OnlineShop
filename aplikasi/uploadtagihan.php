<?php
    if(isset($_POST['upload'])){
        $file = $_FILES['fileku'];
        echo "<script>alert('$file')</script>";
        // $file_name = $_FILES['file']['name'];
        // $file_type = $_FILES['file']['type'];
        // $file_size = $_FILES['file']['size'];
        // $file_tem_loc = $_FILES['file']['tmp_name'];
        // $file_store = "bukti/".$file_name;
    
        // if(move_uploaded_file($file_tem_loc , $file_store)){
        //     echo "<script>alert('Bukti Sudah di upload')</script>";
        // }
    }
?>