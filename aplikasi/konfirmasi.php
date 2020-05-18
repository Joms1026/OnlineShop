<!DOCTYPE html>
<html lang="en">
<head>
  <title>Verifikasi Email</title>
  <meta name="author" content="https://www.maribelajarcoding.com/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" align="center">
  <br>
 <?php
   include "conn.php";
   $token=$_GET['t'];
   $sql = "select * from users where token='$token' and status=0" ;
   $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sqlupdate = "update users set status=1 where token='$token' and status=0";
						if (mysqli_query($conn, $sqlupdate)) {
                            echo '<div class="alert alert-success"> Akun email anda sudah terivikasi, silahkan <a href="index.php">Mengujungi SunShop</a>
                            </div>';
                        }
                        else {
                            echo '<div class="alert alert-warning">Invalid Token! </div>';
                        }
                
        } else {
            echo '<div class="alert alert-warning">
                        Invalid Token!
                        </div>';
        }
 ?>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ec2bb71967ae56c521aec98/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>