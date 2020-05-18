<?php

function connect(){
    $host = "localhost"; // 127.0.0.1
    $user = "root";
    $pass = "";
    $db = "onlineshop";
    
    // Cara Lama
    // $conn = mysqli_connect($host, $user, $pass, $db) or die("Connect Error : " . mysqli_connect_error());
    
    // Object Oriented
    $conn = new mysqli($host , $user, $pass, $db);
    
    if ($conn->connect_errno) {
        die("Failed to connect to MySQL: " . $conn->connect_error);
    }
    return $conn;
}

/**
 * Function untuk update Data
 *
 * @return array
 */
function executeQuery($query, $options= MYSQLI_ASSOC){ 
    // $sql = "SELECT Lastname, Age FROM Persons ORDER BY Lastname";
    $conn = connect();
    $result = $conn->query($query);
    return $result->fetch_all($options);
    // Fetch all
}

/**
 * Function untuk mengambil 1 Row saja (Harus mengembalikan 1 row)
 *
 * @return array
 */
function executeScalar($query){
    $conn = connect();
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC)[0];
}

/**
 * Function untuk melakukan nonQuery (Insert / Update / Delete)
 *
 * @return array
 */
function executeNonQuery($query){
    $conn = connect();
    if ($conn->query($query)) {
        return [
            'status'=>true,
            'message'=>"succes"
        ];
    } else {
        return [
            'status'=>false,
            'message'=>$conn->connect_error
        ];
    }
}






