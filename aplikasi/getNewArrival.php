<?php 
    require_once("conn.php");

    $querySelect = "SELECT * FROM `baju` WHERE status=1 ORDER BY id DESC LIMIT 10";
    $result = mysqli_query($conn, $querySelect);

    if($result->num_rows > 0) {
        $querySelect = "SELECT * FROM `baju` WHERE status=1 ORDER BY id DESC LIMIT 10";
        $isiDB = mysqli_query($conn, $querySelect)->fetch_all();
    } else {
        $isiDB = "none";
    }

    echo json_encode($isiDB);
?>