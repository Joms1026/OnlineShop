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
        $isiDB = "admin/uploads/produk/5eb560e8577d9.jpg";
    }
    echo json_encode($isiDB);
?>