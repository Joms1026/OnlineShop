<?php
    require_once('conn.php');
    if(isset($_POST['btn'])){
        $password = "stefanie";
        $password = password_hash($password, PASSWORD_DEFAULT);
        $queryInsert = "INSERT INTO users VALUES('', 'Stefanie', '$password', 'stefanieangl@gmail.com', '1', 'kapasari 50', '085102093232')";
        $result = mysqli_query($conn, $queryInsert);

        if($result){
            echo "sukses";
        }
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
    <form method="post">
        <input type="submit" name="btn">
    </form>
</body>
</html>