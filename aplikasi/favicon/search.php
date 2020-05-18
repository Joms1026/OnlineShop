<?php 
    require_once("conn.php");

    $key = $_POST['search'];

    $querySelect = "SELECT * FROM baju WHERE nama like '%$key%' AND status=1";
    $result = mysqli_query($conn, $querySelect);

    if($result->num_rows > 0) {
        $querySelect = "SELECT * FROM baju WHERE nama like '%$key%' AND status=1";
        $isiDB = mysqli_query($conn, $querySelect)->fetch_all();
    } else {
        $isiDB = "none";
    }

    echo json_encode($isiDB);
?>