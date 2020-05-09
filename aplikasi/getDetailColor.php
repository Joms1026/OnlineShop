<?php 
    include("conn.php");
    session_start();

    $id = $_POST['idx'];
    $arrWarna = "";

    $querySelect = "SELECT * FROM varian_baju WHERE id_baju=$id";
    $result = mysqli_query($conn, $querySelect)->fetch_all();

    $querySelect = "SELECT id_warna FROM varian_baju WHERE id_baju=$id";
    $ctr = mysqli_query($conn, $querySelect);

    $isiDB = mysqli_query($conn, $querySelect)->fetch_all();
    $isiDB = array_unique($isiDB);

    for ($i=0; $i < $ctr->num_rows; $i++) { 
        $querySelect = "SELECT nama_warna FROM tipe_warna WHERE id_warna=$isiDB[index]";
        $isiWarna = mysqli_query($conn, $querySelect)->fetch_all();
        $isiWarna = array_unique($isiWarna);
    }

    return json_encode($isiWarna);
?>