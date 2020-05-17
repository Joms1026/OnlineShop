<?php
    include("conn.php");
    session_start();
    
    $user=$_SESSION['username'];
    // $user = "stefanie";
    $idx = $_POST['idx'];
    $returnValue = "Gagal menghapus!";

    $querySelect = "SELECT id_user FROM users WHERE nama = '$user'";
    $result = mysqli_query($conn, $querySelect);

    if($result){
        $idUser = mysqli_query($conn, $querySelect)->fetch_assoc();
        $idUser = $idUser['id_user'];
       
        $querySelect2 = "DELETE FROM wishlist WHERE id_user = $idUser AND id_baju = $idx";
        $result3 = mysqli_query($conn, $querySelect2);

        if($result3){
            $returnValue = "Berhasil menghapus item dari wishlist!";
        }
    }

    echo json_encode($returnValue);
?>