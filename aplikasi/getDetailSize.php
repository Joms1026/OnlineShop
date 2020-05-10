<?php 
    include("conn.php");
    session_start();

    $id = $_POST['idx'];
    $isiDB="";

    $querySelect = "SELECT vb.ID_VARIAN, vb.HARGA, vb.STOK,tz.ID_SIZE, tz.NAMA_SIZE
    FROM varian_baju vb
    LEFT OUTER JOIN tipe_size tz ON tz.ID_SIZE = vb.ID_UKURAN
    WHERE vb.ID_BAJU=$id";
    $result = mysqli_query($conn, $querySelect);

    if($result->num_rows > 0){
        $isiDB = mysqli_query($conn, $querySelect)->fetch_all();
    } else {
        $isiDB = "none";
    }

    echo json_encode($isiDB);
?>