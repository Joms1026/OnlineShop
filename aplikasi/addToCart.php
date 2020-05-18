<?php 
    include("conn.php");
    session_start();

    $ukr = $_POST["ukuran"];
    $warna = $_POST["warna"];
    // $us = $_SESSION["username"];
    // $queryidus = "SELECT ID_USER FROM USERS WHERE NAMA='$us'";
    // $res = mysqli_query($conn , $queryidus);
    $iduser = $_SESSION['userid'];
    // while ($row = mysqli_fetch_assoc($res)) {
    //     $iduser = $row["ID_USER"];
    // }
    $idbarang = $_POST["id"];
    $jumlahbarang = $_POST["count"];
    $queryharga = "SELECT HARGA FROM VARIAN_BAJU WHERE ID_BAJU = '$idbarang'";
    $res2 = mysqli_query($conn , $queryharga);
    $hargabarang = 0;
    while ($row = mysqli_fetch_assoc($res2)) {
        $hargabarang = $row["HARGA"];
    }
    $queryinsert = "INSERT INTO KERANJANG VALUES('',$iduser,$idbarang,$jumlahbarang,$hargabarang,'$ukr','$warna')";
    $ins = mysqli_query($conn , $queryinsert);
    echo "jalan";
?>