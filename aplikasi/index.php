<<<<<<< HEAD 
=======
<?php
	session_start();
	//unset($_SESSION["cart"]);
	//nanti saat user logout atau melakukan buy , session akan di unset
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
	
	if(isset($_POST["register"]))
	{
		if($_POST["nama"]<>'' && $_POST["email"]<>'' && $_POST["pass"]<>'' && $_POST["cpass"]<>'')
		{
			if ($_POST["pass"]==$_POST["cpass"])
			{
				$nama=$_POST["nama"];
				$email=$_POST["email"];
				$pass=$_POST["pass"];
				$sql = "Select count(username) as 'jumlah' from user where username='$email'";
				$result = $conn->query($sql);
				if($result->num_rows > 0)
				{	while($row = $result->fetch_assoc())
					{
					$hasil= $row["jumlah"];
					}
				}
				if ($hasil==0)
				{
						
						$sql2 = "INSERT INTO user VALUES('', '$email', '$pass','','$nama',0,0,'','')";
						if($conn->query($sql2) == TRUE)
		
						{
							echo "<script>alert('Insert berhasil');</script>";
						}
						else
						{
							$error = $conn->error;
							echo"<script>alert('$error');</script>";
						}
				}
				else
				{
					echo "<script>alert('Username Sudah Terdaftar');</script>";
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

	if(isset($_POST["login"]))
	{
		$user=$_POST["luser"];
		$pass=$_POST["lpass"];
		$sql = "Select count(EMAIL) as 'jumlah' from user where EMAIL='$user'";
		//echo($sql);
		$result = $conn->query($sql);
		if($result->num_rows > 0)
		{	while($row = $result->fetch_assoc())
			{
			$hasil= $row["jumlah"];
			}
		}
		if ($hasil==0)
		{
			echo "<script>alert('Username Tidak Terdaftar');</script>";
		}
		else
		{
			$sql1 = "Select count(EMAIL) as 'jumlah' from user where EMAIL='$user' and PASSWORD_USER='$pass'";
			$result1 = $conn->query($sql1);
			if($result1->num_rows > 0)
			{	while($row1 = $result1->fetch_assoc())
				{
				$hasil1= $row1["jumlah"];
				}
			}
			if ($hasil1==0)
			{
				echo "<script>alert('Password salah');</script>";
			}
			else
			{
				$_SESSION['username']=$user;
				header('location:home.php');	
			}
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
<<<<<<< HEAD
<<<<<<< HEAD
							<a href="index.html"><img src="images/logo.jpg" width="150px"></a>
=======
							<a href="index.php"><img src="images/logo.jpg" width="150px"></a>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
							<a href="index.php"><img src="images/logo.jpg" width="150px"></a>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="#" class="actived">Home</a></li>
								<li><a href="#">Term & Condition</a></li>
								<li><a href="contact.html">contact</a></li>
							</ul>
							<ul class="navbar_user">
								<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
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
								<li class="checkout">
									<a href="#">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
<<<<<<< HEAD
<<<<<<< HEAD
										<span id="checkout_items" class="checkout_items">
										<?php
											if(isset($_SESSION["cart"])){
												echo count($_SESSION["cart"]);
											}
											else{
												echo "0";
											}
										?>
										</span>
=======
										<span id="checkout_items" class="checkout_items">2</span>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
										<span id="checkout_items" class="checkout_items">2</span>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
									</a>
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

	<!-- Banner -->

	<!--<div class="banner">
<<<<<<< HEAD
<<<<<<< HEAD
		 <div class="container"> -->
=======
		<!-- <div class="container"> -->
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
		<!-- <div class="container"> -->
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
                <!--<div class="row rowbanner">
					<div class="col-md-1"></div>
                    <div class="col-md-4 rowbanner-child" style="background-image:url(images/gambar2.jpg);background-size: contain;background-repeat: no-repeat;background-position: center;cursor:pointer;"></div>
                    <div class="col-md-2 hidden-phone" style="background-image:url(images/gambar4.jpg);background-size: contain;background-repeat: no-repeat;background-position: center;"></div>
                    <div class="col-md-4 rowbanner-child" style="background-image:url(images/gambar3.jpg);background-size: contain;background-repeat: no-repeat;background-position: center;cursor:pointer;"></div>
					<div class="col-md-1"></div>
                </div>-->
		<!-- </div> -->
	<!--</div>-->

	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>New Arrivals</h2>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".men">For Men</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".women">For Women</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".kids">For Kids</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".about">About Us</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

						<!-- Product 1 -->
<<<<<<< HEAD
<<<<<<< HEAD
						<!-- nanti di load dari database-->
=======

>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======

>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						<div class="product-item men">
							<div class="product discount product_filter">
								<div class="product_image">
									<img src="images/product_1.png" alt="">
								</div>
								<div class="favorite favorite_left"></div>
								<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-20.000</span></div>
								<div class="product_info">
									<h6 class="product_name"><a href="single.html">Brown Hoddie</a></h6>
									<div class="product_price">Rp 65.000<span>Rp 85.000</span></div>
								</div>
							</div>
<<<<<<< HEAD
<<<<<<< HEAD
							<form method="post">
								<!-- Untuk menyimpan harga nya , nama nya , dan nama gambar untuk di masukkan ke session cart -->
								<input type="hidden" value='Brown hoddie' name="namaproduk">
								<input type="hidden" value="65.000" name="harga">
								<input type="hidden" value="images/product_1.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						</div>

						<!-- Product 2 -->

						<div class="product-item women">
							<div class="product product_filter">
								<div class="product_image">
									<img src="images/product_2.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center"><span>new</span></div>
								<div class="product_info">
									<h6 class="product_name"><a href="single.html">Navy Dress</a></h6>
									<div class="product_price">Rp 185.000</div>
								</div>
							</div>
<<<<<<< HEAD
<<<<<<< HEAD
							<form method="post">
								<!-- Untuk menyimpan harga nya untuk di masukkan ke session cart -->
								<input type="hidden" value='Navy Dress' name="namaproduk">
								<input type="hidden" value="185.000" name="harga">
								<input type="hidden" value="images/product_2.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>


							<form method="post">
								<!-- Untuk menyimpan harga nya untuk di masukkan ke session cart -->
								<input type="hidden" value='Yellow Gold Sweater' name="namaproduk">
								<input type="hidden" value="125.000" name="harga">
								<input type="hidden" value="images/product_3.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
						</div>
						<!-- Product 4 -->

						<div class="product-item accessories">
							<div class="product product_filter">
								<div class="product_image">
									<img src="images/product_4.png" alt="">
								</div>
								<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
								<div class="favorite favorite_left"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="single.html">Dress</a></h6>
									<div class="product_price">Rp 250.000</div>
								</div>
							</div>

							<form method="post">
								<!-- Untuk menyimpan harga nya untuk di masukkan ke session cart -->
								<input type="hidden" value='Dress' name="namaproduk">
								<input type="hidden" value="250.000" name="harga">
								<input type="hidden" value="images/product_4.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>

							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						</div>

						<!-- Product 5 -->

						<div class="product-item women men">
							<div class="product product_filter">
								<div class="product_image">
									<img src="images/product_5.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="single.html"> T-shirt</a></h6>
									<div class="product_price">Rp 80.000</div>
								</div>
							</div>
<<<<<<< HEAD
<<<<<<< HEAD
							<form method="post">
								<!-- Untuk menyimpan harga nya untuk di masukkan ke session cart -->
								<input type="hidden" value='T-Shirt' name="namaproduk">
								<input type="hidden" value="80.000" name="harga">
								<input type="hidden" value="images/product_5.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						</div>

						<!-- Product 6 -->

						<div class="product-item accessories">
							<div class="product discount product_filter">
								<div class="product_image">
									<img src="images/product_6.png" alt="">
								</div>
								<div class="favorite favorite_left"></div>
								<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-50%</span></div>
								<div class="product_info">
									<h6 class="product_name"><a href="#single.html">Jacket</a></h6>
									<div class="product_price">Rp 75.000<span>$150.0000</span></div>
								</div>
							</div>
<<<<<<< HEAD
<<<<<<< HEAD
							<form method="post">
								<!-- Untuk menyimpan harga nya untuk di masukkan ke session cart -->
								<input type="hidden" value='Jacket' name="namaproduk">
								<input type="hidden" value="75.000" name="harga">
								<input type="hidden" value="images/product_6.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						</div>

						<!-- Product 7 -->

						<div class="product-item women">
							<div class="product product_filter">
								<div class="product_image">
									<img src="images/product_7.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="single.html">Sweeter Brown</a></h6>
									<div class="product_price">Rp 85.000</div>
								</div>
							</div>
<<<<<<< HEAD
<<<<<<< HEAD
							<form method="post">
								<!-- Untuk menyimpan harga nya untuk di masukkan ke session cart -->
								<input type="hidden" value='Sweeter Brown' name="namaproduk">
								<input type="hidden" value="85.000" name="harga">
								<input type="hidden" value="images/product_7.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						</div>

						<!-- Product 8 -->

						<div class="product-item accessories">
							<div class="product product_filter">
								<div class="product_image">
									<img src="images/product_8.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="single.html">Red Women Dress</a></h6>
									<div class="product_price">Rp 350.000</div>
								</div>
							</div>
<<<<<<< HEAD
<<<<<<< HEAD
							<form method="post">
								<!-- Untuk menyimpan harga nya untuk di masukkan ke session cart -->
								<input type="hidden" value='Red Women Dress' name="namaproduk">
								<input type="hidden" value="350.000" name="harga">
								<input type="hidden" value="images/product_8.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						</div>

						<!-- Product 9 -->

						<div class="product-item men">
							<div class="product product_filter">
								<div class="product_image">
									<img src="images/product_9.png" alt="">
								</div>
								<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
								<div class="favorite favorite_left"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="single.html">Jacket</a></h6>
									<div class="product_price">Rp 125.000</div>
								</div>
							</div>
<<<<<<< HEAD
<<<<<<< HEAD
							<form method="post">
								<!-- Untuk menyimpan harga nya untuk di masukkan ke session cart -->
								<input type="hidden" value='Jacket' name="namaproduk">
								<input type="hidden" value="125.000" name="harga">
								<input type="hidden" value="images/product_9.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						</div>

						<!-- Product 10 -->

						<div class="product-item men">
							<div class="product product_filter">
								<div class="product_image">
									<img src="images/product_10.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="single.html">Grey Sweeter</a></h6>
									<div class="product_price">Rp 100.000</div>
								</div>
							</div>
<<<<<<< HEAD
<<<<<<< HEAD
							<form method="post">
								<!-- Untuk menyimpan harga nya untuk di masukkan ke session cart -->
								<input type="hidden" value='Grey Sweeter' name="namaproduk">
								<input type="hidden" value="100.000" name="harga">
								<input type="hidden" value="images/product_10.png" name="gambar">
								<div class="red_button add_to_cart_button"><button type="submit" name="addtocart" class="btn btn-link" style="color:white"> add to cart</button></div>
							</form>
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
							<div class="red_button add_to_cart_button"><a href="detail.html">add to cart</a></div>
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Deal of the week -->

	<div class="deal_ofthe_week">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="deal_ofthe_week_img">
						<img src="images/deal_ofthe_week.png" alt="">
					</div>
				</div>
				<div class="col-lg-6 text-right deal_ofthe_week_col">
					<div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
						<div class="section_title">
							<h2>Deal Of The Week</h2>
						</div>
						<ul class="timer">
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="day" class="timer_num">03</div>
								<div class="timer_unit">Day</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="hour" class="timer_num">15</div>
								<div class="timer_unit">Hours</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="minute" class="timer_num">45</div>
								<div class="timer_unit">Mins</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="second" class="timer_num">23</div>
								<div class="timer_unit">Sec</div>
							</li>
						</ul>
						<div class="red_button deal_ofthe_week_button"><a href="#">shop now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Best Sellers -->

	<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Best Sellers</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">

							<!-- Slide 1 -->

							<div class="owl-item product_slider_item">
								<div class="product-item">
									<div class="product discount">
										<div class="product_image">
											<img src="images/product_1.png" alt="">
										</div>
										<div class="favorite favorite_left"></div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-20.000</span></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Brown Hoodie</a></h6>
											<div class="product_price">Rp 65.000<span>Rp 85.000</span></div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 2 -->

							<div class="owl-item product_slider_item">
								<div class="product-item women">
									<div class="product">
										<div class="product_image">
											<img src="images/product_2.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center"><span>new</span></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Navy Dress</a></h6>
											<div class="product_price">Rp 185.000</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 3 -->

							<div class="owl-item product_slider_item">
								<div class="product-item women">
									<div class="product">
										<div class="product_image">
											<img src="images/product_3.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Blue Yeti USB Microphone Blackout Edition</a></h6>
											<div class="product_price">$120.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 4 -->

							<div class="owl-item product_slider_item">
								<div class="product-item accessories">
									<div class="product">
										<div class="product_image">
											<img src="images/product_4.png" alt="">
										</div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
										<div class="favorite favorite_left"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">DYMO LabelWriter 450 Turbo Thermal Label Printer</a></h6>
											<div class="product_price">$410.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 5 -->

							<div class="owl-item product_slider_item">
								<div class="product-item women men">
									<div class="product">
										<div class="product_image">
											<img src="images/product_5.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Pryma Headphones, Rose Gold & Grey</a></h6>
											<div class="product_price">$180.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 6 -->

							<div class="owl-item product_slider_item">
								<div class="product-item accessories">
									<div class="product discount">
										<div class="product_image">
											<img src="images/product_6.png" alt="">
										</div>
										<div class="favorite favorite_left"></div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Fujifilm X100T 16 MP Digital Camera (Silver)</a></h6>
											<div class="product_price">$520.00<span>$590.00</span></div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 7 -->

							<div class="owl-item product_slider_item">
								<div class="product-item women">
									<div class="product">
										<div class="product_image">
											<img src="images/product_7.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Samsung CF591 Series Curved 27-Inch FHD Monitor</a></h6>
											<div class="product_price">$610.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 8 -->

							<div class="owl-item product_slider_item">
								<div class="product-item accessories">
									<div class="product">
										<div class="product_image">
											<img src="images/product_8.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Blue Yeti USB Microphone Blackout Edition</a></h6>
											<div class="product_price">$120.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 9 -->

							<div class="owl-item product_slider_item">
								<div class="product-item men">
									<div class="product">
										<div class="product_image">
											<img src="images/product_9.png" alt="">
										</div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
										<div class="favorite favorite_left"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">DYMO LabelWriter 450 Turbo Thermal Label Printer</a></h6>
											<div class="product_price">$410.00</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide 10 -->

							<div class="owl-item product_slider_item">
								<div class="product-item men">
									<div class="product">
										<div class="product_image">
											<img src="images/product_10.png" alt="">
										</div>
										<div class="favorite"></div>
										<div class="product_info">
											<h6 class="product_name"><a href="single.html">Pryma Headphones, Rose Gold & Grey</a></h6>
											<div class="product_price">$180.00</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Slider Navigation -->

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Benefit -->

	<!--<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>free shipping</h6>
							<p>Suffered Alteration in Some Form</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>cach on delivery</h6>
							<p>The Internet Tend To Repeat</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>45 days return</h6>
							<p>Making it Look Like Readable</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>opening all week</h6>
							<p>8AM - 09PM</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>-->

	<!-- Blogs -->

	<!--<div class="blogs">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h2>Latest Blogs</h2>
					</div>
				</div>
			</div>
			<div class="row blogs_container">
				<div class="product_slider_container">
					<div class="owl-carousel owl-theme product_slider">
						<div class="col-lg-4 blog_item_col">
								<div class="blog_item">
									<div class="blog_background" style="background-image:url(images/blog_jambi.jpg)"></div>
									<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
										<h4 class="blog_title">Batik Jambi</h4>
										<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
										<a class="blog_more" href="#">Read more</a>
									</div>
								</div>			
						</div>
						<div class="col-lg-4 blog_item_col">
								<div class="blog_item">
									<div class="blog_background" style="background-image:url(images/blog_madura.jpg)"></div>
									<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
										<h4 class="blog_title">Batik Madura</h4>
										<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
										<a class="blog_more" href="#">Read more</a>
									</div>
								</div>
						</div>
						<div class="col-lg-4 blog_item_col">
								<div class="blog_item">
									<div class="blog_background" style="background-image:url(images/blog_sumatra.jpg)"></div>
									<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
										<h4 class="blog_title">Batik Sumatra</h4>
										<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
										<a class="blog_more" href="#">Read more</a>
									</div>
								</div>
						</div>
						<div class="col-lg-4 blog_item_col">
								<div class="blog_item">
									<div class="blog_background" style="background-image:url(images/blog_sumatra.jpg)"></div>
									<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
										<h4 class="blog_title">Batik Sumatra</h4>
										<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
										<a class="blog_more" href="#">Read more</a>
									</div>
								</div>
						</div>
						<div class="col-lg-4 blog_item_col">
							<div class="blog_item">
								<div class="blog_background" style="background-image:url(images/blog_sumatra.jpg)"></div>
								<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
									<h4 class="blog_title">Batik Sumatra</h4>
									<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
									<a class="blog_more" href="#">Read more</a>
								</div>
							</div>
						</div>
						<div class="col-lg-4 blog_item_col">
							<div class="blog_item">
								<div class="blog_background" style="background-image:url(images/blog_sumatra.jpg)"></div>
								<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
									<h4 class="blog_title">Batik Sumatra</h4>
									<span class="blog_meta">by Giovanno Battista | dec 10, 2019</span>
									<a class="blog_more" href="#">Read more</a>
								</div>
							</div>
						</div>
					</div>
					<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
						<i class="fa fa-chevron-left" aria-hidden="true"></i>
					</div>
					<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</div>
	</div>-->

	<!-- Newsletter -->

	<!--<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<h4>Newsletter</h4>
						<p>Subscribe to our newsletter and get 20% off your first purchase</p>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
							<input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
							<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>-->

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
						<ul class="footer_nav">
							<li><a href="#">Blog</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="contact.html">Contact us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
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

	<!-- The social media icon bar -->
	<!--<div class="icon-bar">
		<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
		<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
		<a href="#" class="google"><i class="fa fa-google"></i></a>
		<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
		<a href="#" class="youtube"><i class="fa fa-youtube"></i></a>
	</div>-->

</div>
<div class="box">
    <div class="navbox"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-body">
			<div class="container-login" id="container-login">
				<div class="form-container sign-up-container">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
<<<<<<< HEAD
<<<<<<< HEAD
					<form action="#" class="form-login">
						<h3>Create Account</h3>
						<br>
						<input type="text" placeholder="Name" />
						<input type="email" placeholder="Email" />
						<input type="password" placeholder="Password" />
						<input type="password" placeholder="Confirm Password" />
						<br>
						<button class="button-login">Register</button>
=======
=======
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
					<form action="Index.php" method="post" class="form-login">
						<h3>Create Account</h3>
						<br>
						<input type="text" name ="nama" placeholder="Name" />
						<input type="email" name ="email" placeholder="Email" />
						<input type="password" name ="pass" placeholder="Password" />
						<input type="password" name ="cpass" placeholder="Confirm Password" />
						<br>
						<button type="submit" name="register" class="button-login">Register</button>
<<<<<<< HEAD
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
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
<<<<<<< HEAD
<<<<<<< HEAD
					<form action="#" class="form-login">
						<h3>Sign in</h3>
						<br>
						<input type="email" placeholder="Email" />
						<input type="password" placeholder="Password" />
						<br>
						<button class="button-login">Sign In</button>
=======
=======
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
					<form action="index.php" method="post" class="form-login">
						<h3>Sign in</h3>
						<br>
						<input type="email" name ="luser" placeholder="Email" />
						<input type="password" name ="lpass" placeholder="Password" />
						<br>
						<button typr="submit" name ="login" class="button-login">Sign In</button>
<<<<<<< HEAD
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
=======
>>>>>>> 54193dc3869312fb61b5285261012ec3bf0b9aff
						<br>
						<span>or use your account for login</span>
						<div class="social-container">
							<a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
							<a href="#" class="social"><i class="fa fa-google"></i></a>
						</div>
						<br>
						<a href="#">Forgot your password?</a>
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
	const container = document.getElementById('container-login');

	$('#btnToTop').fadeOut();

	$( "#signUp" ).click(function() {
		$(".sign-in-container").hide();
		$(".sign-up-container").show();
		container.classList.add("right-panel-active");
	});

	$( "#signIn" ).click(function() {
		$(".sign-in-container").show();
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
</script>

<script type="text/javascript">
	/*var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/5dedcbe1d96992700fcb5cbd/1drnchuei';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();*/

	$(document).ready(function(){
		loadAllProduct();

		/*$("#id").submit(function(e){
			e.preventDefault(); // mencegah page reload

			$.ajax({
				method : "post", 
				url : ".php", 
				data : $("#id").serialize(), 
				success : function(result){
					
				}
			});
		});*/
	});

	function loadAllProduct(){
		// load product saat pertama kali halaman dibuka

		$.ajax({
			method : "post", 
			url : "ajax/getAllProduct.php",  
			success : function(result){
				var allProduct = JSON.parse(result);
				
				// code here
			}
		});
	}
</script>