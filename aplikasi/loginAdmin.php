<?php
    include("conn.php");
    session_start();

    $_SESSION['admin'] = "";

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $querySelect = "SELECT * FROM users WHERE email_user = '$email' AND role=1";
        $result = mysqli_query($conn, $querySelect);

        if($result){
            $querySelect = "SELECT * FROM users WHERE email_user = '$email' AND role=1";
            $isiDB = mysqli_query($conn, $querySelect)->fetch_assoc();
            
            if(password_verify($pass, $isiDB['PASSWORD_USER'])){
                $_SESSION['admin'] = $isiDB['username'];
                header("Location: admin/dashboard.php");
            } else {
                echo "<script> alert('Pastikan email dan password benar!') </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
</head>
<body>
    <div id="container" style="border: 1px dotted black; margin: 0; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">
        <h1 style="text-align: center">Login Admin</h1> <br/>
        <form method="POST" id="formLoginAdmin">
            &nbsp; &nbsp; &nbsp;
            Email : <input type="text" name="email">
            <br/> <br/>
            &nbsp; &nbsp; &nbsp;
            Password : <input type="password" name="pass"> 
            &nbsp; &nbsp; &nbsp;
            <br/> <br/>
            &nbsp; &nbsp; &nbsp;
            <input type="submit" name="submit" value="Login"> <br/> <br/>
        </form>
    </div>
</body>
</html>