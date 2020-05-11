<?php 
    session_start();
    $type = $_POST["shipping"];
    $harga = 0;
    if($type == "nd"){
        $harga = 100;
    }   
    else if($type == "sd"){
        $harga = 50;
    }
    else if($type == "free"){
        $harga = 0;
    }
    echo $harga;
?>