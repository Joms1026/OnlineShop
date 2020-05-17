<?php
    include("conn.php");
    session_start();

	$user=$_SESSION['username'];

    if (isset($_POST['Logout'])) {
        header('location:index.php');
        unset($_SESSION['username']);
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
<style>
	* {box-sizing: border-box}
	.mySlides1, .mySlides2 {display:none}
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
        display: flex;
        justify-content: center;
        transform: translateY(100px);
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
<!-- <div class="preloader-full-height" id="preloading">
	<img id="me" src="images/logo-icon.png" style= "margin-top : -145px">
	<h4 style= "color: white; margin-top : -125px" >LOADING ...</h4>
</div> -->

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
								<li><a href="home.php">Home</a></li>
                                <li><a href="chat.php">Chat</a></li>
                                <li><a href="#" class="actived">Wishlist</a></li>
							</ul>
							<ul class="navbar_user">
								<!-- <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li> -->
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
											<form action="index.php" method="POST" style="margin-left:-22px; margin-top:-12px ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<button name = "Logout" type="submit" ><span style="margin-left:-10px;">Logout</span></button>  
          									</form>	
											
											</div>
										</div>
									</ul>
								</li>
								<li class="checkout">
									<a href="cart.php">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span id="checkout_items" class="checkout_items">
											<?php
												$querystring = "SELECT * FROM KERANJANG K , USERS U WHERE U.NAMA='$user' AND K.ID_USER = U.ID_USER";
												$res = mysqli_query($conn , $querystring);
												echo mysqli_num_rows($res);
											?>
										</span>
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

	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
                        <h1 style="transform: translateY(200px)">Wishlist</h1>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div id="product-grid" class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }' style="display:flex;flex-wrap:wrap;  justify-content: center; transform: translateY(150px)">
						<!-- Product -->
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		$geser = "0";
		$querySelect = "SELECT id_user FROM users WHERE nama='$user'";
		$result = mysqli_query($conn, $querySelect);

		if($result){
			$id = mysqli_query($conn, $querySelect)->fetch_assoc();
			$id = $id['id_user'];
			$querySelect = "SELECT * FROM wishlist WHERE id_user=$id";
			$result = mysqli_query($conn, $querySelect);

			if($result){
				if($result->num_rows < 5){
					$geser = "600px";
				} else {
					$geser = $result->num_rows / 3 * 350 + 250;
					$geser = $geser."px";
				}
			}
		}
	?>

	<div class="deal_ofthe_week" style="transform:translateY(<?= $geser ?>)">
		<div id="shadow" style="height:<?= $geser ?>; background-color:white"></div>
	</div>
	
	<!-- Best Sellers -->

	<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<!-- <h2>Best Sellers</h2> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<!-- <div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider"> 

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div> 
					</div> -->
				</div>
			</div>
		</div>
	</div>

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
		loadWishlist();
    });

	const container = document.getElementById('container-login');

	$('#btnToTop').fadeOut();

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
				price = harga['harga'] + "";
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
    
    function loadWishlist(){
		$("#product-grid").html('');
		$.ajax({
			method: "post",
			url : "getWishlist.php",
			success : function(res){
				var isiProduct = JSON.parse(res);

				if(isiProduct != "none"){
					for (let index = 0; index < isiProduct.length; index++) {
						$("#product-grid").append(`
							<div class="product-item"id="product${isiProduct[index][0]}" >
								<div class="product product_filter" >
									<div class="product_image" >
										<div id="product-image${isiProduct[index][0]}" alt="" style="margin: 5px 5% 0px; width: 90%; height: 100%"></div>
									</div>
									<div class="favorite"></div>
									<div class="product_info">
										<h6 class="product_name"><a href="single.html">${isiProduct[index][1]}</a></h6>
										<div class="product_price" id="product_price${isiProduct[index][0]}"></div>
									</div>
								</div>
								<div id="product-button${isiProduct[index][0]}"> </div>
							</div>
						`);
						ambilHarga(isiProduct[index][0]);
						ambilGambar(isiProduct[index][0]);

						var newElementDetail = $('<button type="submit" id="btnDetail" style="width: 99%; height:25px; background-color: red; color: white; transform:translateY(-25px)">Show Detail</button>');
						newElementDetail.on("click", {"idx": isiProduct[index][0], "nama": isiProduct[index][1]}, fungsiBtnDetail);
						$("#product-button"+isiProduct[index][0]).append(newElementDetail);

						var newElementDelete = $('<button type="submit" id="btnDelete" style="width: 99%; height:25px; background-color: red; color: white; transform:translateY(-25px)">Delete</button>');
						newElementDelete.on("click", {"index": isiProduct[index][0]}, fungsiBtnDelete);
						$("#product-button"+isiProduct[index][0]).append(newElementDelete);
					}
				} else {
					$("#product-grid").append("<h3> Belum Ada Barang Tersedia! </h3>");
				}
			}
		})
	};

	function fungsiBtnDetail(e){
		var idxBtnDetail = e.data.idx;
		window.location.href = `detailLogin.php?idx=${idxBtnDetail}`;
	}

	function fungsiBtnDelete(e){
		var idx = e.data.index;

		$.ajax({
			method : "post",
			url : "deleteWishlist.php",
			data : `idx=${idx}`,
			success : function(res) {
				var result = JSON.parse(res);
				loadWishlist();
			}
		});
	}
</script>