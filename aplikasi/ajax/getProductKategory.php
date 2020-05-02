<?php
    require_once('conn.php');
    // untuk select product yang sesuai dengan yang dicari dari database

    // $kategory = $_POST['...'];
    // isi .... dgn var yg menampung nama kategori

    $querySelect = "SELECT * FROM kategori WHERE nama_kategori = '$kategory'";
    $isi = mysqli_query($conn, $querySelect)->fetch_assoc(); // mengambil 1 row data yg nama kategorinya sesuai
    $id = $isi['id_kategori']; // mengambil id-nya saja

    $querySelect = "SELECT * FROM kategori_barang WHERE id_kategori = $id"; // mengambil barang yang kategorinya sesuai
    $returnValue = mysqli_query($conn, $querySelect)->fetch_all();

    echo json_encode($returnValue);
?>