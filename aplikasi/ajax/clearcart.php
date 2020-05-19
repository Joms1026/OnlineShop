<?php
    session_start();
    include('../conn.php');
    $userid = $_SESSION["userid"];
    $querydelete = "DELETE FROM KERANJANG WHERE ID_USER = $userid";
    $resdel = mysqli_query($conn , $querydelete);
    echo "berhasil";
?>