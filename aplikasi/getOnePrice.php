<?php 
    include("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT HARGA FROM varian_baju WHERE ID_BAJU=$id";
    $result = mysqli_query($conn, $querySelect);

    if($result->num_rows > 0){
        $querySelect = "SELECT HARGA FROM varian_baju WHERE ID_BAJU=$id";
        $isiDB = mysqli_query($conn, $querySelect)->fetch_assoc();
    } else {
        $isiDB = "none";
    }

    echo json_encode($isiDB);
?>