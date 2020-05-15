<?php 
    include("conn.php");
    session_start();

    $ukr = "";

    if(isset($_POST['ukuran'])){
        $ukr = $_POST["ukuran"];
    }

    echo json_encode($ukr);
?>