<?php 
    include("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT link_gambar FROM gambar WHERE id_baju=$id";
    $result = mysqli_query($conn, $querySelect);

    if($result->num_rows > 0){
        $querySelect = "SELECT link_gambar FROM gambar WHERE id_baju=$id";
        $isiDB = mysqli_query($conn, $querySelect)->fetch_assoc();
        $tempIsi = $isiDB['link_gambar'];
        $isiDB = "admin/uploads/produk/$id/$tempIsi";
    } else {
        $isiDB = "none";
    }
    echo json_encode($isiDB);
?>