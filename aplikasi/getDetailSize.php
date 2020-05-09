<?php 
    include("conn.php");
    session_start();

    $id = $_POST['idx'];
    $arrSize = "";

    $querySelect = "SELECT * FROM varian_baju WHERE id_baju=$id";
    $result = mysqli_query($conn, $querySelect)->fetch_all();

    $querySelect = "SELECT id_size FROM varian_baju WHERE id_baju=$id";
    $ctr = mysqli_query($conn, $querySelect);

    $isiDB = mysqli_query($conn, $querySelect)->fetch_all();
    $isiDB = array_unique($isiDB);

    for ($i=0; $i < $ctr->num_rows; $i++) { 
        $querySelect = "SELECT nama_size FROM tipe_size WHERE id_size=$isiDB[index]";
        $isiSize = mysqli_query($conn, $querySelect)->fetch_all();
        $isiSize = array_unique($isiSize);
    }

    echo json_encode($isiSize);
?>