<?php
    session_start();
    include_once("conn.php");
    
    $user=$_SESSION['username'];
    $idUser = $_SESSION['userid'];

    $idx = $_POST['idx'];
    $returnValue = "Gagal menambahkan ke wishlist!";
       
    $querySelect2 = "SELECT * FROM wishlist WHERE ID_USER = $idUser";
    $result3 = mysqli_query($conn, $querySelect2);

    $insert = true;
    if($result3){
        $isiDB = mysqli_query($conn, $querySelect2)->fetch_all();
        for ($i=0; $i < $result3->num_rows; $i++) { 
            if($isiDB[$i][1] == $idx){
                $insert = false;
            } 
        }
    } else {
        $insert = true;
    }

    if($insert == true){
        $queryInsert = "INSERT INTO wishlist VALUES('', $idx, $idUser)";
        $result2 = mysqli_query($conn, $queryInsert);
        if($result2) $returnValue = "Berhasil menambahkan ke wishlist!";
    } else {
        $returnValue = "Barang sudah ada di wishlist!";
    }
    
    echo json_encode($returnValue);
?>