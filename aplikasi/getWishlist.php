<?php
    include("conn.php");
    session_start();
    
    $user=$_SESSION['username'];
    // $user = "stefanie";
    $returnValue = "none";

    $querySelect = "SELECT id_user FROM users WHERE nama = '$user'";
    $result = mysqli_query($conn, $querySelect);

    if($result){
        $idUser = mysqli_query($conn, $querySelect)->fetch_assoc();
        $idUser = $idUser['id_user'];

        $querySelect = "SELECT DISTINCT w.ID_Baju, b.NAMA, g.LINK_GAMBAR FROM wishlist w 
        LEFT OUTER JOIN gambar g on w.ID_Baju = g.ID_GAMBAR 
        LEFT OUTER JOIN baju b on b.id = w.ID_Baju 
        WHERE w.id_user = $idUser";
        $result = mysqli_query($conn, $querySelect);

        if($result){
            $isiDB = mysqli_query($conn, $querySelect)->fetch_all();

            for ($i=0; $i < $result->num_rows; $i++) { 
                $id = $isiDB[$i][0];
                $tempIsi = $isiDB[$i][2];
                $isiDB[$i][2] = "admin/uploads/produk/$id/$tempIsi";

                $querySelect2 = "SELECT harga FROM varian_baju WHERE id_baju=$id";
                $result2 = mysqli_query($conn, $querySelect2);

                if($result2){
                    $isiDB2 = mysqli_query($conn, $querySelect2)->fetch_assoc();
                    $isiDB[$i][3] = $isiDB2['harga'];
                }
            }
            $returnValue = $isiDB;
        }
    }

    echo json_encode($returnValue);
?>