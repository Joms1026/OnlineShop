<?php
    include('conn.php');
    $angkanya = $_POST["a"];
    $harga = $_POST["h"];
    $queryupdate = "UPDATE KERANJANG SET JUMLAH_BARANG = '$angkanya', HARGA_BARANG = '$harga'";
    $res = mysqli_query($conn , $queryupdate);
    echo "yes";
?>