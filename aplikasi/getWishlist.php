<?php
    include("conn.php");
    session_start();
    
    $user=$_SESSION['username'];
    $idUser = $_SESSION['userid'];
    $returnValue = "none";


    $querySelect = "SELECT DISTINCT w.ID_Baju, b.NAMA, g.LINK_GAMBAR FROM wishlist w 
    LEFT OUTER JOIN gambar g on w.ID_Baju = g.ID_GAMBAR 
    LEFT OUTER JOIN baju b on b.ID = w.ID_Baju 
    WHERE w.ID_USER = $idUser";
    $result = mysqli_query($conn, $querySelect);

    if($result){
        $isiDB = mysqli_query($conn, $querySelect)->fetch_all();

        for ($i=0; $i < $result->num_rows; $i++) { 
            $id = $isiDB[$i][0];
            $tempIsi = $isiDB[$i][2];
            $isiDB[$i][2] = "admin/uploads/produk/$id/$tempIsi";

            $querySelect2 = "SELECT HARGA FROM varian_baju WHERE ID_BAJU=$id";
            $result2 = mysqli_query($conn, $querySelect2);

            if($result2){
                $isiDB2 = mysqli_query($conn, $querySelect2)->fetch_assoc();
                $isiDB[$i][3] = $isiDB2['HARGA'];
            }
        }
        $returnValue = $isiDB;
    }

    echo json_encode($returnValue);
?>