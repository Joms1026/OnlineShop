<?php
	include "conn.php";
	session_start();
	$token=$_GET['t'];
	$email=$_GET['e'];
	if(isset($_GET["login"])) {
		$_SESSION['token']=  $_GET["token11"];
		$_SESSION['email']= $_GET["email11"];;
		if ($_GET["pass"] == $_GET["cp"])
		{
			$emails= $_SESSION['email'];
			$passh= $_SESSION['token'];
			$pass1 = password_hash($_GET["pass"], PASSWORD_DEFAULT);
			$sqlupdate = "UPDATE users SET PASSWORD_USER='$pass1' WHERE EMAIL_USER='$emails' AND TOKEN='$passh'";
			if (mysqli_query($conn, $sqlupdate)) {
				echo "<script>alert('Password Anda Telah berhasil direset');</script>";
				header('location:index.php');
			 }
			 else {
				echo "<script>alert('gagal reset password! silahkan forget lagi');</script>";
				//header("location: index.php");
			 }
			
		}
		else{
			echo "<script>alert('New Password dan Confrim Password tdk sama');</script>";
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reset Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fg/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fg/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fg/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fg/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="fg/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fg/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fg/css/util.css">
	<link rel="stylesheet" type="text/css" href="fg/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('fg/images/img-01.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form action="forget.php" method="GET" class="login100-form validate-form" style = "margin-top:-95px">
					<div class="login100-form-avatar">
						<img src="fg/images/avatar-02.jpg" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						<?php $emailuser=$_GET['e']; echo "$emailuser" ?>
					</span>
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="New Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="cp" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button type="submit" name ="login" class="login100-form-btn">
							Reset Password
						</button>
					</div>
					
					<div class="text-center w-full p-t-25 p-b-230">
						<a class="txt1" href="Index.php">
							Create new account
							<i class="fa fa-long-arrow-right"></i>						
						</a>
						<input name="token11" value='<?php echo $_GET['t'];?>' type="hidden" >
	                <input name="email11" value='<?php echo $_GET['e'];?>' type="hidden">
					</div>
					
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="fg/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="fg/vendor/bootstrap/js/popper.js"></script>
	<script src="fg/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="fg/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="fg/js/main.js"></script>

</body>
</html>