<?php 
    include("conn.php");
    session_start();

    $id = $_POST['idx'];
    $isiDB="";

    $querySelect = "SELECT vb.ID_VARIAN, vb.HARGA, vb.STOK, tw.ID_WARNA ,tw.NAMA_WARNA
    FROM varian_baju vb
    LEFT OUTER JOIN tipe_warna tw ON  tw.ID_WARNA = vb.ID_WARNA
    WHERE vb.ID_BAJU=$id";
    $result = mysqli_query($conn, $querySelect);

    if($result->num_rows > 0){
        $isiDB = mysqli_query($conn, $querySelect)->fetch_all();
    } else {
        $isiDB="none";
    }

    echo json_encode($isiDB);
?>