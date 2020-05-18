<?php
	include("conn.php");
	session_start();
	$user=$_SESSION['username'];
	$userid = $_SESSION['userid'];

	if(!isset($_SESSION['username'])){
		header('location:index.php');
	}

	if(isset($_POST["continueshopping"])){
		header("Location: home.php");
	}

	if(isset($_POST["btnCheckout"])){	
		header("Location: checkout.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sun Shop</title>

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
<link rel="stylesheet" type="text/css" href="styles/cart.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
<!-- <link rel="manifest" href="/manifest.json"> -->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<!--
	selanjut nya
-->
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/additional_styles.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" type="text/css" href="styles/login.css">
<link rel="stylesheet" type="text/css" href="styles/preloader.css">
<style>
	.madiv{
		display : none;
	}
</style>
</head>

<body>
<div class="preloader-full-height" id="preloading">
	<img id="me" src="images/logo-icon.png">
	<h4>LOADING ...</h4>
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
							<a href="index.html"><img src="images/logo.jpg" width="150px"></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="#" class="actived">Shopping</a></li>
								<li><a href="home.php">Home</a></li>
								<li><a href="wishlist.php">Wishlist</a></li>
							</ul>
								<li class="account">
									<a>
										<i class="fa fa-user" aria-hidden="true"></i>
									</a>
									<ul class="account_selection">
										<div class="widgets_div" >
											<div class="icon_div">
												<span><i class="fa fa-user"></i></span>
											</div>
											<div class="text_div">
												<span><?php  echo($user); ?></span>
											</div>
										</div>
										<div class="widgets_div" >
											<div class="icon_div">
												<span><i class="fa fa-sign-out"></i></span>
											</div>
											<div class="text_div">
											<form action="home.php" method="POST" style="margin-left:-22px; margin-top:-12px ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<button name = "Logout" type="submit" ><span style="margin-left:-10px;">Logout</span></button>  
          									</form>	
											
											</div>
										</div>
									</ul>
								</li>
								<!-- <li class="checkout">
									<a href="#">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span id="checkout_items" class="checkout_items">
										
											// $querystring = "SELECT * FROM KERANJANG K , USERS U WHERE U.ID_USER='$userid' AND K.ID_USER = U.ID_USER";
											// $res = mysqli_query($conn , $querystring);
											// //echo mysqli_num_rows($res);
											/	/ if($res) echo mysqli_num_rows($res);
											// else echo "0";
										
										</span>
									</a>
								</li> -->
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
				<!--<li class="menu_item"><a href="#">Term & Condition</a></li>
				<li class="menu_item"><a href="contact.html">contact</a></li> -->
			</ul>
		</div>
		<div class="hamburger_footer"><img src="images/logo.jpg" width="160px"></div>
	</div>

	<!-- Slider -->

	<div class="main_slider">
			<div class="row">
					<div class="col text-center">
						<div class="section_title">
							<h2>Shopping Cart </h2>
						</div>
					</div>
			</div>	
	</div>
	<!-- cart-->
	<div class="cart_section">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="cart_container">

							<table class="cart" width="100%">
								<thead>
									<tr>
										<td style="width: 5%;">#</td>
										<td style="width: 50%;">Product</td>
										<td style="width: 10%;">Size</td>
										<td style="width: 10%;">Price</td>
										<td style="width: 10%;">Quantity</td>
										<td style="width: 10%;">Total</td>
									</tr>
								</thead>
								<tbody id="tablecart">
									<?php
										//$us = $_SESSION["username"];
										$querystring = "SELECT DISTINCT K.SIZE , K.ID_KERANJANG , K.ID_USER , K.ID_BARANG , K.JUMLAH_BARANG , K.HARGA_BARANG , G.LINK_GAMBAR , B.NAMA
										FROM KERANJANG K , USERS U , BAJU B , GAMBAR G
										WHERE K.ID_USER = '$userid' AND G.ID_BAJU = K.ID_BARANG AND B.ID = K.ID_BARANG AND B.ID = G.ID_BAJU
										GROUP BY K.SIZE , K.ID_KERANJANG , K.ID_USER , K.ID_BARANG , K.JUMLAH_BARANG , K.HARGA_BARANG , B.NAMA";
										$res = mysqli_query($conn , $querystring);
										
										if(mysqli_num_rows($res) == 0){
											echo '<td colspan="6"><div class="alert alert-danger" role="alert">
 												 Tidak ada barang di dalam cart
											</div></td>';
										}
										else{
										$ctr = 0;
										while ($row = mysqli_fetch_assoc($res)) {
										echo	"<tr>
										<td>".($ctr + 1)."</td>
										<td>
											<div class='row py-2'>
												<div class='col-lg-2'>
													<img src='admin/uploads/produk/".$row["ID_BARANG"]."/".$row["LINK_GAMBAR"]."' alt=''>
												</div>
												<div class='col-lg-10'>
													<div class='product_name mt-0'><a href='product.html'>".$row["NAMA"]."</a></div>
													<div class='product_text'>Second line for additional info</div>
												</div>
											</div>
											<div class='madiv' id='hidden".$ctr."'>".$row["ID_BARANG"]."</div>
										</td>
										<td>".$row['SIZE']."</td>
										<td id='price".$ctr."'>".$row["HARGA_BARANG"]."</td>
										<td><div class='product_quantity ml-lg-auto mr-lg-auto text-center'>
											<span class='product_text product_num' id='angka".$ctr."'>".$row["JUMLAH_BARANG"]."</span>
											<div class='qty_sub qty_button trans_200 text-center' id='minus".$ctr."'><span>-</span></div>
											<div class='qty_add qty_button trans_200 text-center' id='plus".$ctr."'><span>+</span></div>
										</div></td>
										<td id='total".$ctr."'>
											<script>
												document.getElementById('total".$ctr."').innerHTML = document.getElementById('angka".$ctr."').innerHTML * ".$row['HARGA_BARANG']."
											</script></td>
										</tr> <br>";
										$ctr++;
										}
										}
									?>									 
								</tbody>
							</table>

							<!-- Cart Buttons -->
							<div class="cart_buttons d-flex flex-row align-items-start justify-content-start">
								<div class="cart_buttons_inner ml-sm-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
									<form method="post" id="clearcart">
										<button type="submit" name="btnClear" class="border-0 btn btn-secondary mr-2">
											<!-- <div class="button button_clear trans_200" name="clearcart"> -->
												<!-- <a style="color:white"> -->
												Clear Cart
												<!-- </a> -->
											<!-- </div> -->
										</button>
									</form>
									<form method="post">
										<button type="submit" name="continueshopping" class="border-0 btn btn-success">
											<!-- <div class="button button_continue trans_200">
												<a style="color:white"> -->
												Continue Shopping
												<!-- </a> -->
											<!-- </div> -->
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row cart_extra_row">
					<div class="col-lg-6">
						<div class="cart_extra cart_extra_1">
							<div class="cart_extra_content cart_extra_coupon">
								<!-- <div class="cart_extra_title">Coupon code</div>
									<div class="coupon_form_container">
									<form action="#" id="coupon_form" class="coupon_form">
										<input type="text" class="coupon_input" required="required">
										<button class="coupon_button">apply</button>
									</form>
								</div> 
								<div class="coupon_text">Phasellus sit amet nunc eros. Sed nec congue tellus. Aenean nulla nisl, volutpat blandit lorem ut.</div>-->
								<div class="shipping">
									<div class="cart_extra_title">Shipping Method</div>
									<ul>
										<form name="shipping">
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_1" name="shipping_radio" class="shipping_radio" value="nd">
												<span class="radio_mark"></span>
												<span class="radio_text">Next day delivery</span>
											</label>
											<div class="shipping_price ml-auto">100.000</div>
										</li>
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_2" name="shipping_radio" class="shipping_radio" value="sd">
												<span class="radio_mark"></span>
												<span class="radio_text">Standard delivery</span>
											</label>
											<div class="shipping_price ml-auto">50.000</div>
										</li>
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_3" name="shipping_radio" class="shipping_radio" value="free" checked>
												<span class="radio_mark"></span>
												<span class="radio_text">Personal Pickup</span>
											</label>
											<div class="shipping_price ml-auto">Free</div>
										</li>
										</form>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 cart_extra_col">
						<div class="cart_extra cart_extra_2">
							<div class="cart_extra_content cart_extra_total">
								<div class="cart_extra_title">Cart Total</div>
								<ul class="cart_extra_total_list">
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Subtotal</div>
										<div class="cart_extra_total_value ml-auto" id="subtotal"></div>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Shipping</div>
										<div class="cart_extra_total_value ml-auto" id="shippingtype">Free</div>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Total</div>
										<div class="cart_extra_total_value ml-auto" id="carttotal"></div>
									</li>
								</ul>
								<form method="post">
									<button type="submit" name="btnCheckout" class="checkout_button trans_200 btn btn-success">
											Proceed to Checkout
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	

	<!-- Blogs -->

	<!-- <div class="blogs">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h2>Latest Blogs</h2>
					</div>
				</div>
			</div>
			<div class="row blogs_container">
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
			</div>
		</div>
	</div> -->

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

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-body">
			<div class="container-login" id="container-login">
				<div class="form-container sign-up-container">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<form action="#" class="form-login">
						<h3>Create Account</h3>
						<br>
						<input type="text" placeholder="Name" />
						<input type="email" placeholder="Email" />
						<input type="password" placeholder="Password" />
						<input type="password" placeholder="Confirm Password" />
						<br>
						<button class="button-login">Register</button>
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
					<form action="#" class="form-login">
						<h3>Sign in</h3>
						<br>
						<input type="email" placeholder="Email" />
						<input type="password" placeholder="Password" />
						<br>
						<button class="button-login">Sign In</button>
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
<script src="styles/bootstrap-4.1.2/popper.js"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/cart.js"></script>
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

	//simpantotalbelanja
	function simpantotalnya(totalbelanja){
			$.ajax({
			method : "post", // metode ajax
			url : "ajax/simpantotal.php", // tujuan request
			data : {
				total : totalbelanja
			}, // data yang dikirim
			success : function(res){
				$('#subtotal').html('');
				$('#subtotal').append(parseInt(res));
				hitung();
			}
			});
	}

	//hitung
	function hitung(){
		var total = parseInt(document.getElementById("subtotal").innerHTML);
		var shipping = document.getElementById('shippingtype').innerHTML;
		var shipping2 = 0;
		if(shipping == "Free" || shipping == "free"){
			shipping2 = 0;
		}
		else{
			shipping2 = parseInt(shipping);
		}
		//alert(shipping2);
		var result = parseInt(total) + parseInt(shipping2);
		$("#carttotal").html('');
		$("#carttotal").append(result);
		//shippingcek(shipping2);
		$.ajax({
			method : "post",
			url : "saveresult.php",
			data: {
				totals : result,
				shippingtype : shipping2,
			}
		})
	}

	//buattotal
	function refreshtotal(){
		var totalbelanja = 0;
		for (let index = 0; index < <?=mysqli_num_rows($res)?>; index++) {
			totalbelanja += parseInt(document.getElementById('total'+index.toString()).innerHTML);
		}
		simpantotalnya(totalbelanja);
		hitung();
	}

	//shipppingcek
	function shippingcek(shippingtype){
		$.ajax({
			method : "post", // metode ajax
			url : "ajax/simpanshipping.php", // tujuan request
			data : {
				shipping : shippingtype
			}, // data yang dikirim
			success : function(res){
				if(res == 0){
					$("#shippingtype").html('');
					$("#shippingtype").append("free");
				}
				else{
					$("#shippingtype").html('');
					$("#shippingtype").append(res);
				}
				hitung();
			}
		});
	}

	//Ganti shipping
	var shippingtype = "";
	var radios = document.forms["shipping"].elements["shipping_radio"];
	for(var i = 0, max = radios.length; i < max; i++) {
    	radios[i].onclick = function() {
        	shippingtype = this.value;
			shippingcek(shippingtype);
			refreshtotal();
    	}
	}

	//bikin penambahan qty
	try {
		for (let index = 0; index < <?=mysqli_num_rows($res);?>; index++) {
			document.getElementById("minus"+index.toString()).addEventListener("click", function(){
				var angkanya = parseInt(document.getElementById('angka'+index.toString()).innerHTML) - 1;
				var harganya = parseInt(document.getElementById("price"+index.toString()).innerHTML);
				var idbarang = parseInt(document.getElementById("hidden"+index.toString()).innerHTML);
				if(angkanya <= 0){
					angkanya = 1;
				}
				var hasil = angkanya * harganya;
				document.getElementById("total"+index.toString()).innerHTML = hasil;
				refreshtotal();
				$.ajax({
					method : "post", // metode ajax
					url : "editqtycart.php", // tujuan request
					data : {
						a : angkanya,
						h : harganya,
						id : idbarang,
					}, // data yang dikirim
					success : function(res){
						//alert(res);
						if(angkanya == 1){
							document.getElementById('angka'+index.toString()).innerHTML = angkanya;
						}
					}
				});
			});
		}
		for (let index = 0; index < <?=mysqli_num_rows($res)?>; index++) {
			document.getElementById("plus"+index.toString()).addEventListener("click", function(){
				var angkanya = parseInt(document.getElementById('angka'+index.toString()).innerHTML) + 1;
				var harganya = parseInt(document.getElementById("price"+index.toString()).innerHTML);
				var idbarang = parseInt(document.getElementById("hidden"+index.toString()).innerHTML);
				var hasil = angkanya * harganya;
				document.getElementById("total"+index.toString()).innerHTML = hasil;
				refreshtotal();
				$.ajax({
					method : "post", // metode ajax
					url : "editqtycart.php", // tujuan request
					data : {
						a : angkanya,
						h : harganya,
						id : idbarang,
					}, // data yang dikirim
					success : function(res){
						//alert(res);
					}
				});
			});
		}
	} catch (error) {
		
	}

	$(document).ready(function(){
		$("#clearcart").submit(function(e){
			e.preventDefault();

			$.ajax({
          		method : "post", // metode ajax
          		url : "ajax/clearcart.php", // tujuan request
         	 	data : $("#clearcart").serialize(), // data yang dikirim
          		success : function(res){
					if(res.match("sukses")){
						alert('Cart cleared');
						$("#tablecart").html('');
						$("#tablecart").append(`<td colspan="6">
						<div class="alert alert-danger" role="alert>
							Tidak ada barang dalam cart
						</div>
						</td>`);
					}
          		}
        	});	
		});		
			//alert('halo');
		refreshtotal();
		shippingcek(shippingtype);
	});

</script>