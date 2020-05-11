<?php 
    include("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT link_gambar FROM gambar WHERE id_baju=$id";
    $result = mysqli_query($conn, $querySelect)->fetch_all();

    echo json_encode($result);
?>