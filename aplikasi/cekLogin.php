<?php
    require_once('conn.php');
    session_start();

    $arr[] = "";
    $username = $_POST['luser'];
    $password = $_POST['lpass'];

    if((!empty($username)) && (!empty($password))){
        $querySelect = "SELECT * FROM users WHERE email_user = '$username' AND verify_email = 1";
        $result = mysqli_query($conn, $querySelect)->fetch_assoc();
        
        if(password_verify($password, $result['PASSWORD_USER']) == true){
            $arr = $result;
        } 
        else {
            $arr = "Gagal login 1!";
        }
    } else {
        $arr = "Gagal login!";
    }

    echo json_encode($arr);
?>