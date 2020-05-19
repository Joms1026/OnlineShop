<?php 
    include("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT ID, DESKRIPSI FROM baju WHERE ID = $id";
    $result = mysqli_query($conn, $querySelect)->fetch_assoc();

    echo json_encode($result);
?>