<?php
    include('conn.php');
    $angkanya = $_POST["a"];
    $harga = $_POST["h"];
    $idbarang = $_POST["id"];
    $queryupdate = "UPDATE keranjang SET JUMLAH_BARANG = '$angkanya', HARGA_BARANG = '$harga' WHERE ID_BARANG = $idbarang";
    $res = mysqli_query($conn , $queryupdate);
    echo "yes";
?>