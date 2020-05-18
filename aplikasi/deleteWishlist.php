<?php
    include("conn.php");
    session_start();
    
    $user=$_SESSION['username'];
    $idUser = $_SESSION['userid'];
    
    $idx = $_POST['idx'];
    $returnValue = "Gagal menghapus!";

       
    $querySelect2 = "DELETE FROM wishlist WHERE id_user = $idUser AND id_baju = $idx";
    $result3 = mysqli_query($conn, $querySelect2);

    if($result3){
        $returnValue = "Berhasil menghapus item dari wishlist!";
    }
    
    echo json_encode($returnValue);
?>