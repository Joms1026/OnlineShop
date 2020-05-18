<?php 
    include("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT harga FROM varian_baju WHERE id_baju=$id";
    $result = mysqli_query($conn, $querySelect);

    if($result->num_rows > 0){
        $querySelect = "SELECT harga FROM varian_baju WHERE id_baju=$id";
        $isiDB = mysqli_query($conn, $querySelect)->fetch_assoc();
    } else {
        $isiDB = "none";
    }

    echo json_encode($isiDB);
?>