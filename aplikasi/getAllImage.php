<?php 
    include("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT LINK_GAMBAR FROM gambar WHERE ID_BAJU=$id";
    $result = mysqli_query($conn, $querySelect)->fetch_all();

    echo json_encode($result);
?>