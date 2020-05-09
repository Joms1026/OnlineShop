<?php 
    include("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT deskripsi FROM baju WHERE id = $id";
    $result = mysqli_query($conn, $querySelect)->fetch_assoc();

    echo json_encode($result);
?>