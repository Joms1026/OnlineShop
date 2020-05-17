<?php 
    session_start();
    $type = $_POST["shipping"];
    $harga = 0;
    if($type == "nd"){
        $harga = 100000;
    }   
    else if($type == "sd"){
        $harga = 50000;
    }
    else if($type == "free"){
        $harga = 0;
    }
    $_SESSION["shipping"] = $harga;
    echo $harga;
?>