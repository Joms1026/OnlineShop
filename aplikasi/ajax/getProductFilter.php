<?php
    require_once('conn.php');
    // untuk select product yang sesuai dengan yang dicari dari database

    $namaBarang = $_POST['search'];

    $querySelect = "SELECT * FROM barang WHERE lower(nama_barang) like '%lower($namaBarang)%'";
    $returnValue = mysqli_query($conn, $querySelect)->fetch_all();

    echo json_encode($returnValue);
?>