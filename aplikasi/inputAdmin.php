<?php
    include("conn.php");

    $pass = password_hash("pass", PASSWORD_DEFAULT);
    
    if(isset($_POST['btnInput'])){
        $queryInsert = "INSERT INTO users VALUES('', 'nama', '$pass','email', 1, 'admin', 1, '', '')";
        $executeQuery = mysqli_query($conn, $queryInsert);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form name="inputAdmin" method="post">
        <button name="btnInput">Input</button>
    </form>
</body>
</html>