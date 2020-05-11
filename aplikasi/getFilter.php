<?php 
    require_once("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT * FROM baju WHERE id_kategori=$id";
    $result = mysqli_query($conn, $querySelect);

    if($result->num_rows > 0) {
        $querySelect = "SELECT * FROM baju WHERE id_kategori=$id";
        $isiDB = mysqli_query($conn, $querySelect)->fetch_all();
    } else {
        $isiDB = "none";
    }

    echo json_encode($isiDB);
?>