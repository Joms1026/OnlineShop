<?php
    require_once('conn.php');

    $returnValue = "";

    if((!empty($_POST['nama'])) && (!empty($_POST['email']))){
        if((!empty($_POST['pass'])) && (!empty($_POST['cpass']))){
            
            $username = $_POST['nama'];
            $pass = $_POST['pass'];
            $cpass = $_POST['cpass'];
            $email = $_POST['email'];

            $querySelect = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $querySelect);
            // echo var_dump($result);

            if($result->num_rows == 1){
                $returnValue = "Username telah digunakan!";
            } else {
                if($pass == $cpass){
                    $pass = password_hash($pass, PASSWORD_DEFAULT);
                    $queryInsert = "INSERT INTO users VALUES('', '$username', '$pass', '$email', '1', '', '0', '', '')";
                    $result = mysqli_query($conn, $queryInsert);

                    if($result) $returnValue = "success";
                    else $returnValue = "failed";
                }
                else{
                    $returnValue = "Password dan confirm password harus sama!";
                }
                
            }
        } else {
            $returnValue = "Semua field harus terisi!";
        }
    }
    else {
        $returnValue = "Semua field harus terisi!";
    }
    echo json_encode($returnValue);
?>