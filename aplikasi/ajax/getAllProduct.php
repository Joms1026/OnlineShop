<?php
    require_once('conn.php');
    // untuk select semua product yang ada dari database

    $querySelect = "SELECT * FROM barang";
    $returnValue = mysqli_query($conn, $querySelect)->fetch_all();

    echo json_encode($returnValue);
?>