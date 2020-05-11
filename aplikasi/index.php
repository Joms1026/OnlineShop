<?php
include("conn.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();

if(isset($_POST["login"]))
	{
		$user = $_POST["Luser"];
        $pass = $_POST["Lpass"];
        $sql = "select * from users where email='$user'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
				
					if (password_verify($pass, $row["PASSWORD_USER"])) {
						if ($row["STATUS"] == "0") {
							echo "<script>alert('mohon maaf anda harus verifikasi email terlebih dahulu')</script>";
						}
						else if ($row["STATUS"] == "1") {
							if ($row["ROLE"] == "0") {
								$_SESSION['username']= $row["username"];
								$user=$_SESSION['username'];
								echo "<script>alert('$user')</script>";
								header("location: home.php");
							} else if ($row["ROLE"] == "1") {
								$_SESSION['username']= $row["username"];
								header("location: admin.php");
							} 
						}
					} else {
						echo "<script>alert('password salah')</script>";
					}
            }
        } else {
            echo "<script>alert('username tidak ada')</script>";
        }
	}
if(isset($_POST["register"]))
	{
		if($_POST["nama"]<>'' && $_POST["email"]<>'' && $_POST["pass"]<>'' && $_POST["cpass"]<>'')
		{
			if ($_POST["pass"]==$_POST["cpass"])
			{
				$email=$_POST["email"];
				$sql = "Select count(email) as 'jumlah' from users where email='$email'";
				$result = $conn->query($sql);
				if($result->num_rows > 0)
				{	while($row = $result->fetch_assoc())
					{
					$hasil= $row["jumlah"];
					}
				}
				
				if ($hasil==0)
				{
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$nama=$_POST["nama"];
						$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
						$token=hash('sha256', md5(date('Y-m-d'))) ;
						$sql = "insert into users(email_user,password_user,username,role,status,token) values('$email','$pass','$nama',0,0,'$token')";
						if (mysqli_query($conn, $sql)) {
							echo "<script>alert('Register berhasil segera check email buat mengaktifkan akun');</script>";
							//Send Email
								require 'vendor/autoload.php';
								$mail = new PHPMailer(true);    
								$body = "<body style='margin: 10px;'>
								<div style='width: 640px; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
								<br>
								<strong>Terima Kasih Telah Melakukan Pendaftaran pada website sunshop.com segera lakukan verifikasi dengan mengklik url dibawah ini</strong><br>
								<b>Nama Anda : </b>".$nama."<br>
								<b>Email : </b>".$email."<br>
								<b>URL Konfirmasi : </b><a href='http://localhost/OnlineShop/OnlineShop/aplikasi/konfirmasi.php?t=".$token."'>http://localhost/OnlineShop/OnlineShop/aplikasi/konfirmasi.php?t=".$token."</a><br>
								<br>
								</div>
								</body>";
								try {
									$mail->SMTPDebug = 0;                          
									$mail->isSMTP();                   
									$mail->Host = 'smtp.gmail.com'; 
									$mail->SMTPAuth = true;         
									$mail->Username = 'sunshopaplinproyek@gmail.com'; 
									$mail->Password = 'uyxztavypnxjlimc'; 
									$mail->SMTPSecure = 'ssl';   
									$mail->Port = 465;
									$mail->setFrom('sunshopaplinproyek@gmail.com', 'verifikasi Sun Shop');
									$mail->addAddress($email, $nama); 
									$mail->isHTML(true);      
									$mail->Subject = 'Sun Shop Online';
									$mail->Body    = $body;
									$mail->AltBody = 'This is the body ';
								
									$mail->send();
									echo 'Message has been sent';
								} catch (Exception $e) {
									echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
								}

								if(!$mail->Send()) {
									echo "Oops, Mailer Error: " . $mail->ErrorInfo;
								} else {
									echo "Mail Sukses";
								}

							//
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						
					} else {
						echo "<script>alert('$email Harap masukkan email dengan benar');</script>";
					}
					
				}
				else
				{
					echo "<script>alert('Email Sudah Teregister');</script>";
				}
			}
			else{
				echo "<script>alert('Password dan Confrim Password tdk sama');</script>";
			}
		} 
		else
		{
			echo "<script>alert('Harus Terisi Semua !');</script>";
		}
	}

	if(isset($_POST["forgetpass"]))
	{
		if($_POST["forgetemail"]<>'' )
		{
			$email=$_POST["forgetemail"];
			$sql = "Select count(email_user) as 'jumlah',username,token from user where email_user='$email'";
			$result = $conn->query($sql);
				if($result->num_rows > 0)
				{	while($row = $result->fetch_assoc())
					{
						$hasil= $row["jumlah"];
						$namauser= $row["usename"];
						$tokenuser= $row["token"];
					}
					if ($hasil==1){
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
							//Send Email
							require 'vendor/autoload.php';
							$mail = new PHPMailer(true);    
							$body = "<body style='margin: 10px;'>
							<div style='width: 640px; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
							<br>
							<strong>User telah Forget Password Sunshop.com jika anda benar ingin mereset Password segera reset password dengan  melakukan mengganti password baru dengan mengklik url dibawah ini</strong><br>
							<b>Nama Anda : </b>".$namauser."<br>
							<b>Email : </b>".$email."<br>
							<b>URL Konfirmasi : </b><a href='http://localhost/proyek/sunshop.com/forget.php?t=".$tokenuser."&e=".$email."'>http://localhost/proyek/sunshop.com/forget.php?t=".$tokenuser."&e=".$email."'</a><br>
							<br>
							</div>
							</body>";
							try {
								$mail->SMTPDebug = 0;                          
								$mail->isSMTP();                   
								$mail->Host = 'smtp.gmail.com'; 
								$mail->SMTPAuth = true;         
								$mail->Username = 'sunshopaplinproyek@gmail.com'; 
								$mail->Password = 'uyxztavypnxjlimc'; 
								$mail->SMTPSecure = 'ssl';   
								$mail->Port = 465;
								$mail->setFrom('sunshopaplinproyek@gmail.com', 'Forget Password Sun Shop');
								$mail->addAddress($email, $nama); 
								$mail->isHTML(true);      
								$mail->Subject = 'Sun Shop Online';
								$mail->Body    = $body;
								$mail->AltBody = 'This is the body ';
								$mail->send();
								echo "<script>alert('Message has been sent');</script>";
							} catch (Exception $e) {
								echo "<script>alert('Message could not be sent. forget password Error:', $mail->ErrorInfo);</script>";
							}
							if(!$mail->Send()) {
								echo "<script>alert('Oops, Mailer Error: ' . $mail->ErrorInfo);</script>";
							} else {
								echo "<script>alert('Forget Password Sukses');</script>";
							}
						}
						else {
							echo "<script>alert('$email Harap masukkan email dengan benar');</script>";
						}
					}
					else
					{
						echo "<script>alert('Email Belum Teregister');</script>";
					}
				}
				else {
					echo "<script>alert('Error:  '. $sql .' <br> '. mysqli_error($conn));</script>";
				}
		}
		else
		{
			echo "<script>alert('Email Harus Terisi!!!');</script>";
		}
	}

	if(isset($_POST["addtocart"])){
		echo "<script>alert('Berhasil')</script>";
		$arrtemp = array(
			"namaproduk" =>  $_POST["namaproduk"],
			"harga" => $_POST["harga"],
			"gambar" => $_POST["gambar"],
		);
		if(!isset($_SESSION["cart"])){
			$datacart = array();
			array_push($datacart , $arrtemp);
			$_SESSION["cart"] = $datacart;
			header("Location: cart.php");
		}
		else{
			$datacart = $_SESSION["cart"];
			array_push($datacart , $arrtemp);
			$_SESSION["cart"] = $datacart;
			header("Location: cart.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sun Shop</title>
<script type="text/javascript" src="jquery.js"></script>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sun Shop">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	* {box-sizing: border-box}
	.mySlides1, .mySlides2 {display: none}
	img {vertical-align: middle;}

	/* Slideshow container */
	.slideshow-container {
	max-width: 1000px;
	position: relative;
	margin: auto;
	}

	/* Next & previous buttons */
	.prev, .next {
	cursor: pointer;
	position: absolute;
	top: 50%;
	width: auto;
	padding: 16px;
	margin-top: -22px;
	color: white;
	font-weight: bold;
	font-size: 18px;
	transition: 0.6s ease;
	border-radius: 0 3px 3px 0;
	user-select: none;
	}

	/* Position the "next button" to the right */
	.next {
	right: 0;
	border-radius: 3px 0 0 3px;
	}

	/* On hover, add a grey background color */
	.prev:hover, .next:hover {
	background-color: #f1f1f1;
	color: black;
	}
</style>
<!--
	Favicon
-->
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
<!-- <link rel="manifest" href="/manifest.json"> -->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<!--
	selanjut nya
-->
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/additional_styles.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" type="text/css" href="styles/login.css">
<link rel="stylesheet" type="text/css" href="styles/preloader.css">
<link rel="stylesheet" type="text/css" href="styles/modal.css">
</head>

<body>
<div class="preloader-full-height" id="preloading">
	<img id="me" src="images/logo-icon.png" style= "margin-top : -145px">
	<h4 style= "color: white; margin-top : -125px" >LOADING ...</h4>
</div>

<div class="super_container">

	<!-- Header -->

	<header class="header trans_300">

		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						<div class="logo_container">
							<!-- <div class="logo"></div> -->
							<a href="index.php"><img src="images/logo.jpg" width="150px"></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="#" class="actived">Home</a></li>
								<li><a href="#">Term & Condition</a></li>
							</ul>
							<ul class="navbar_user">
								<!-- <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li> -->
								<li class="account">
									<a>
										<i class="fa fa-user" aria-hidden="true"></i>
									</a>
									<ul class="account_selection">
										<div class="widgets_div" onclick="showLoginModal()">
											<div class="icon_div">
												<span><i class="fa fa-sign-in"></i></span>
											</div>
											<div class="text_div">
												<span>Sign In</span>
											</div>
										</div>
										<div class="widgets_div" onclick="showRegisterModal()">
											<div class="icon_div">
												<span><i class="fa fa-user-plus"></i></span>
											</div>
											<div class="text_div">
												<span>Register</span>
											</div>
										</div>
									</ul>
								</li>
							</ul>
							<div class="hamburger_container">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
						</nav>
					</div>
				</div>
			</div>

			<hr class="hr-brown">
			<hr class="hr-red">
			<hr class="hr-brown">
		</div>

	</header>

	<div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li class="menu_item has-children">
					<a href="#">
						My Account
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a onclick="showLoginModal()">Sign In&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
						<li><a onclick="showRegisterModal()">Register&nbsp;&nbsp;<i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
					</ul>
				</li>
				<li class="menu_item"><a href="#">Term & Condition</a></li>
				<li class="menu_item"><a href="contact.html">contact</a></li>
			</ul>
		</div>
		<div class="hamburger_footer"><img src="images/logo.jpg" width="160px"></div>
	</div>

	<!-- Slider -->

	<div class="main_slider">
		<div class="main_slider_banner" style="background-image:url(images/gambar1-fade.jpg);">
			<div class="container fill_height">
				<div class="row align-items-center fill_height">
					<div class="col">
						<div class="main_slider_content">
							<br>
							<h2>Get up to 30% Off New <br>Arrivals</h2>
							<br>
							<form role="form" id="form-buscar">
								<div class="form-group">
									<div class="input-group">
										<input id="1" class="form-control" type="text" name="search" placeholder="What can I help you with today?" id="search-bar"/>
										<span class="input-group-btn">
											<button class="btn btn-brown" type="submit">
												<i class="fa fa-search" aria-hidden="true"></i>
											</button>
										</span>
									</div>
								</div>
							</form>
						</div>
						<br>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="new_arrivals">
		<div class="container">
			<div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" name="ALL" value="ALL">ALL</li>
							<?php
								$querySelect = "SELECT * FROM kategori WHERE status=1";
								$result = mysqli_query($conn, $querySelect);

								if($result->num_rows > 0){
									$querySelect = "SELECT * FROM kategori WHERE status=1";
									$isiDB = mysqli_query($conn, $querySelect)->fetch_all();

									for ($i=0; $i < $result->num_rows; $i++) { ?>
										<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" name="<?= $isiDB[$i][1]; ?>" value="<?= $isiDB[$i][1]; ?>"><?= $isiDB[$i][1]; ?></li>
									<?php }
								}
							?>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div id="product-grid" class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }' style="display:flex;flex-wrap:wrap;  justify-content: center">
						<!-- Product -->
						
					</div>
				</div>
			</div>
			<!-- <div id="new-arrivals"> 
			<?php
				// $querySelect = "SELECT * FROM baju WHERE status = 1";
				// $result = mysqli_query($conn, $querySelect);
				// $geser = $result->num_rows / 3 * 300;
				// $geser = $geser."px";
			?> -->
			<!-- <div class="row" style="transform: translateY()">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>New Arrivals</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">
							<!-- Slide New Arrival -->
							<!-- <div class="owl-item product_slider_item">
								<div class="product-item">
									<div class="product discount" id="product-new"> -->
										<!-- <div class="product_image">
											<img src="images/product_1.png" alt="">
										</div>
										<div class="favorite favorite_left"></div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-20.000</span></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Brown Hoodie</a></h6>
											<div class="product_price">Rp 65.000<span>Rp 85.000</span></div>
										</div>
									<!-- </div> -->
								<!-- </div>
							</div>
						</div>  --> 
						
						<!-- Slider Navigation -->
						<!-- <div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div style="height:<?= $geser ?>"></div>
	</div>

	<footer class="footer" style="transform: translateY(100px)">
		<div class="container">
			<div style="height:150px">

			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="footer_nav_container">
						<div class="cr">©2020 <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#">Sun Shop</a></div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<div class="btn-group-fab" role="group" aria-label="FAB Menu" onclick="scrollToTop()" id="btnToTop">
		<div>
			<button type="button" class="btn btn-main btn-primary has-tooltip" data-placement="left" title="Menu"> <i class="fa fa-arrow-up"></i> </button>
		</div>
	</div>
</div>
<div class="box">
    <div class="navbox"></div>
</div>
<!--modal send email -->

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="container-login" id="container-login">
					<div class="form-container sign-up-container">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<form action="Index.php" method="post" class="form-login">
							<h3>Create Account</h3>
							<br>
							<input type="text" name ="nama" placeholder="Name" />
							<input type="email" name ="email" placeholder="Email" />
							<input type="password" name ="pass" placeholder="Password" />
							<input type="password" name ="cpass" placeholder="Confirm Password" />
							<br>
							<button type="submit" name="register" class="button-login">Register</button>
							<br>
							<span>or use your account for login</span>
							<div class="social-container">
								<a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
								<a href="#" class="social"><i class="fa fa-google"></i></a>
							</div>
						</form>
					</div>
					<div class="form-container sign-in-container">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<form action="index.php" method="post" class="form-login">
							<h3>Sign in</h3>
							<br>
							<input type="email" name ="Luser" placeholder="Email" />
							<input type="password" name ="Lpass" placeholder="Password" />
							<br>
							<button type="submit" name ="login" class="button-login">Sign In</button>
							<br>
							<span>or use your account for login</span>
							<div class="social-container">
								<a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
								<a href="#" class="social"><i class="fa fa-google"></i></a>
							</div>
							<br>
							<button type="button" class="btn btn-danger" id="exampleModal">Forgot your password?</button>
						</form>
					</div>
					<div class="form-container forget-in-container">
						<form action="index.php" method="post" class="form-login">
							<h3>Forget Password</h3>
							<br>
							<input type="email" name ="forgetemail" placeholder="Email" />
							<button typr="submit" name ="forgetpass" class="button-login">Send Email</button>
							<br>
						</form>
					</div>
					<div class="overlay-container">
						<div class="overlay">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<div class="overlay-panel overlay-left">
								<p>Keep connected with us</p>
								<button class="button-login ghost" id="signIn">Sign In</button>
							</div>
							<div class="overlay-panel overlay-right">
								<h1></h1>
								<p>Enter your personal details and start journey with us</p>
								<button class="button-login ghost" id="signUp">Register</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modalDetail">
 	<div id="myModal" class="modal" style="background-color:white; width:300px; transform: translateX(75%);">
		<!-- Modal content -->
		<div class="modal-content">
			<div class="modal-header">
				<h2 id="modalHeader"></h2>
				<button style="background:transparent" id="btnClose">&times;</button>
			</div> <br/>
			<div id="modalBody">
				<div class="slideshow-container" id="slideshow-container" style="height: 210px"></div>
				<p id="deskripsi"></p>
				<p id="harga"></p>
				<form id="formDetail"></form>
				<form id="formBtn"></form>
			</div>
		</div>
	</div>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
<script src="js/preload.js"></script>
</body>

</html>


<script>
	$(document).ready(function(){
		//alert("jalan");
		loadProduct();
	});

	const container = document.getElementById('container-login');

	$('#btnToTop').fadeOut();

	$( "#signUp" ).click(function() {
		$(".sign-in-container").hide();
		$(".forget-in-container").hide();
		$(".sign-up-container").show();
		container.classList.add("right-panel-active");
	});

	$( "#signIn" ).click(function() {
		$(".sign-in-container").show();
		$(".sign-up-container").hide();
		$(".forget-in-container").hide();
		container.classList.remove("right-panel-active");
	});

	$( "#exampleModal" ).click(function() {
		$(".forget-in-container").show();
		$(".sign-in-container").hide();
		$(".sign-up-container").hide();
		container.classList.remove("right-panel-active");
	});

	$(window).scroll(function() {
		if ($(this).scrollTop()) {
			$('#btnToTop:hidden').stop(true, true).fadeIn();
		} else {
			$('#btnToTop').stop(true, true).fadeOut();
		}
	});

	function scrollToTop(){
		$('html, body').animate({scrollTop: '0px'}, 300);
	}
	
	function showLoginModal(){
		$("#signIn").trigger( "click" );
		$("#loginModal").modal("toggle");
	}
	
	function showRegisterModal(){
		$("#signUp").trigger( "click" );
		$("#loginModal").modal("toggle");
	}

	// function loadNewArrivals(){
	// 	$("#product-new").html('');
	// 	$.ajax({
	// 		method: "post",
	// 		url : "getNewArrival.php",
	// 		success : function(res){
	// 			var isiProduct = JSON.parse(res);
	// 			var jumlah = isiProduct.length;
	// 			//console.log(isiProduct);
	// 			var ctr = 0; 
	// 			for (let index = 0; index < isiProduct.length; index++) {
	// 				$("#product-new").append(`
					
	// 					<div class="product_image">
	// 						<img src="images/product_1.png" alt="">
	// 					</div>
	// 					<div class="favorite favorite_left"></div>
	// 						<div class="product_info">
	// 							<h6 class="product_name"><a href="single.html">Brown Hoodie</a></h6>
	// 							<div class="product_price">Rp 65.000</div>
	// 						</div>
	// 					</div>
	// 				`);
	// 				ambilHarga(isiProduct[index][0]);
	// 				ambilGambar(isiProduct[index][0]);

	// 				var newElementDetail = $('<button type="submit" id="btnDetail" style="width: 195px; height:25px; background-color: red; color: white">Show Detail</button>');
	// 				newElementDetail.on("click", {"idx": isiProduct[index][0], "nama": isiProduct[index][1]}, fungsiBtnDetail);
	// 				$("#product-button"+isiProduct[index][0]).append(newElementDetail);
	// 			}
	// 		}
	// 	})
	// }

	function loadProduct(){
		$("#product-grid").html('');
		$.ajax({
			method: "post",
			url : "getAllProduct.php",
			success : function(res){
				var isiProduct = JSON.parse(res);
				var jumlah = isiProduct.length;
				//console.log(isiProduct);
				var ctr = 0; 
				for (let index = 0; index < isiProduct.length; index++) {
					$("#product-grid").append(`
						<div id="product-wrap" style="width:205px; height:305px">
							<div id="product${isiProduct[index][0]}" style="border:solid 1px black; width:200px; height:300px">
								<div id="product-image${isiProduct[index][0]}" style="height:145px; transform: translateX(50px) translateY(5px)">
								</div>
								<div class="favorite favorite_left"></div>
								<div class="product_info" style="height:95px">
									<h6 class="product_name">${isiProduct[index][1]}</h6>
									<div class="product_price" id="product_price${isiProduct[index][0]}"></div>
								</div>
								<div id="product-button${isiProduct[index][0]}"> </div>
							</div> 
						</div>
					`);
					ambilHarga(isiProduct[index][0]);
					ambilGambar(isiProduct[index][0]);

					var newElementDetail = $('<button type="submit" id="btnDetail" style="width: 195px; height:25px; background-color: red; color: white">Show Detail</button>');
					newElementDetail.on("click", {"idx": isiProduct[index][0], "nama": isiProduct[index][1]}, fungsiBtnDetail);
					$("#product-button"+isiProduct[index][0]).append(newElementDetail);
				}
			}
		})
	};

	function ambilGambar(id){
		$.ajax({
			method : "post",
			url : "getOneImage.php",
			data : `idx=${id}`,
			success : function (result) {
				var srcGambar = JSON.parse(result);
				var img = new Image(100,145);
				img.src=srcGambar;
				document.getElementById('product-image'+id).appendChild(img); 
			}
		})
	}

	function ambilHarga(ind){
		var price = 0;
		$.ajax({
			method : "post",
			url : "getOnePrice.php",
			data : `idx=${ind}`,
			success : function (result) {
				var harga = JSON.parse(result);
				price = harga['harga'] + 0;
				$("#product_price"+ind).append(`<p> ${formatRupiah(price, "Rp.")}</p>`);
			}
		});
	}

	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
	
		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
	
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}

	function fungsiBtnDetail(e){
		e.preventDefault();
		// alert("btn detail pressed");
		var idxBtnDetail = e.data.idx;
		var namaBrg = e.data.nama;

		$("#myModal").show();
		$("#modalHeader").html('');
		$("#formDetail").html('');
		$("#formBtn").html('');
		$("#slideshow-container").html('');
		$("#modalHeader").append(`${namaBrg}`);
		
		$.ajax({
			method : "post",
			url : "getDeskripsi.php",
			data : `idx=${idxBtnDetail}`,
			success : function (r) {
				var detail = JSON.parse(r);
				$("#deskripsi").html('');
				$("#deskripsi").append(`
					&nbsp; &nbsp; &nbsp;
					deskripsi : ${detail}
				`);
			}
		})

		ambilSemuaGambar(idxBtnDetail);
		addRbSize(idxBtnDetail);
		addRbColor(idxBtnDetail);
		add();
	}
	
	function ambilSemuaGambar(id) {
		$.ajax({
			method : "post",
			url : "getAllImage.php",
			data : `idx=${id}`,
			success : function (result) {
				var gambar = JSON.parse(result);
				for (let index = 0; index < gambar.length; index++) {
					srcGambar = `admin/uploads/produk/${id}/${gambar[index]}`;
					$("#slideshow-container").append(`
						<div class="mySlides1" style="transform:translateX(75px)">
							<img src=${srcGambar} style="width:150px; height:200px;">
						</div>
					`);
				}
				$("#slideshow-container").append(`
					<a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
					<a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
				`);
			}
		})
	}

	function addRbSize(ind){
		var arrSize = [];

		$.ajax({
			method : "post",
			url : "getDetailSize.php",
			data : `idx=${ind}`,
			success : function (result) {
				var detail = JSON.parse(result);

				$("#formDetail").append("&nbsp; &nbsp; &nbsp; Size : ");
				for (let index = 0; index < detail.length; index++) {
					var masuk = true;
					for (let i = 0; i < arrSize.length; i++) {
						if(arrSize[i] == detail[index][4]){
							masuk = false;
						}
					}
					if(masuk == true){
						arrSize.push(detail[index][4]);

						if(index == 0){
							$("#formDetail").append(`
								<input type="radio" name="ukuran" value="${detail[index][4]}">${detail[index][4]} <br/>
							`);
						} else {
							$("#formDetail").append(`
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
								<input type="radio" name="ukuran" value="${detail[index][4]}">${detail[index][4]} <br/>
							`);
						}
					}
				}
				$("#formDetail").append("<br/>");
			}
		});
	}

	function  addRbColor(ind) {
		var arrColor = [];
		
		$.ajax({
			method : "post",
			url : "getDetailColor.php",
			data : `idx=${ind}`,
			success : function (result) {
				var detail = JSON.parse(result);
				
				$("#formDetail").append("&nbsp; &nbsp; &nbsp; Color : ");
				for (let index = 0; index < detail.length; index++) {
					var masuk = true;
					for (let i = 0; i < arrColor.length; i++) {
						if(arrColor[i] == detail[index][4]){
							masuk = false;
						}
					}
					if(masuk == true){
						arrColor.push(detail[index][4]);

						if(index == 0){
							$("#formDetail").append(`
								<input type="radio" name="warna" value="${detail[index][4]}">${detail[index][4]}  <br/>
							`);
						} else {
							$("#formDetail").append(`
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
								<input type="radio" name="warna" value="${detail[index][4]}">${detail[index][4]}  <br/>
							`);
						}
					}	
				}
				$("#formDetail").append("<br/>");
			}
		})
	}

	function add() {
		$("#formBtn").append(`
			&nbsp; &nbsp; &nbsp;
			Jumlah : <input type="number" name="count" value="1" min="1"> <br/>
			<br/> &nbsp; &nbsp; 
			<input type="submit" name="btnAdd" value="Add to Cart" style="background-color:red; color:white; width:245px">
		`)
	}

	$("#btnClose").click(function (params) {
		$("#myModal").hide()
	});

	var slideIndex = [1,1];
	var slideId = ["mySlides1", "mySlides2"]
	showSlides(1, 0);
	showSlides(1, 1);

	function plusSlides(n, no) {
		showSlides(slideIndex[no] += n, no);
	}

	function showSlides(n, no) {
		var i;
		var x = document.getElementsByClassName(slideId[no]);
		if (n > x.length) {slideIndex[no] = 1}    
		if (n < 1) {slideIndex[no] = x.length}
		for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";  
		}
		x[slideIndex[no]-1].style.display = "block"; 
	}
</script>