<?php 
    include("conn.php");
    session_start();

    $ukr = $_POST["ukuran"];
    $warna = $_POST["warna"];
    $us = $_SESSION["username"];
    $iduser = $_SESSION["userid"];
    $idbarang = $_POST["id"];
    $jumlahbarang = $_POST["count"];
    $queryharga = "SELECT HARGA FROM varian_baju WHERE ID_BAJU = '$idbarang'";
    $res2 = mysqli_query($conn , $queryharga);
    $hargabarang = 0;
    while ($row = mysqli_fetch_assoc($res2)) {
        $hargabarang = $row["HARGA"];
    }
    $queryinsert = "INSERT INTO keranjang VALUES('',$iduser,$idbarang,$jumlahbarang,$hargabarang,'$ukr','$warna')";
    $ins = mysqli_query($conn , $queryinsert);
    echo "jalan";
?>