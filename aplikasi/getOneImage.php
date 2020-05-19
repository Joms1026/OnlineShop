<?php 
    include("conn.php");

    $id = $_POST['idx'];

    $querySelect = "SELECT LINK_GAMBAR FROM gambar WHERE ID_BAJU=$id";
    $result = mysqli_query($conn, $querySelect);

    if($result->num_rows > 0){
        $querySelect = "SELECT LINK_GAMBAR FROM gambar WHERE ID_BAJU=$id";
        $isiDB = mysqli_query($conn, $querySelect)->fetch_assoc();
        $tempIsi = $isiDB['LINK_GAMBAR'];
        $isiDB = "admin/uploads/produk/$id/$tempIsi";
    } else {
        $isiDB = "none";
    }
    echo json_encode($isiDB);
?>