<?php 
    include("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT id, deskripsi FROM baju WHERE id = $id";
    $result = mysqli_query($conn, $querySelect)->fetch_assoc();

    echo json_encode($result);
?>