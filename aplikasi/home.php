<?php
include("conn.php");
session_start();
$user=$_SESSION['username'];

if(!isset($_SESSION['username'])){
	header('location:index.php');
}

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
							<a href="index.html"><img src="images/logo.jpg" width="150px"></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="#" class="actived">Home</a></li>
								<li><a href="chat.php">Chat</a></li>
								<li><a href="wishlist.php">Wishlist</a></li>
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
											<form action="home.php" method="POST" style="margin-left:-22px; margin-top:-12px ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
												//echo mysqli_num_rows($res);
												if($res) echo mysqli_num_rows($res);
												else echo "0";
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
							<form role="form" id="form-Search">
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

	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<!-- <div class="section_title new_arrivals_title">
						<h2>New Arrivals</h2>
					</div> -->
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" id="ALL" value="ALL">ALL</li>
							<?php
								$querySelect = "SELECT * FROM kategori WHERE status=1";
								$result = mysqli_query($conn, $querySelect);

								if($result->num_rows > 0){
									$querySelect = "SELECT * FROM kategori WHERE status=1";
									$isiDB = mysqli_query($conn, $querySelect)->fetch_all();

									for ($i=0; $i < $result->num_rows; $i++) { ?>
										<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" onclick="btnFilter(<?= $isiDB[$i][0]; ?>)"><?= $isiDB[$i][1]; ?></li>
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
		</div>
	</div>

	<?php
		$querySelect = "SELECT * FROM baju WHERE status = 1";
		$result = mysqli_query($conn, $querySelect);
		$geser = "0";
		if($result->num_rows < 5){
			$geser = "400px";
		} else {
			$geser = $result->num_rows / 3 * 350;
			$geser = $geser."px";
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
		//alert("jalan");
		loadProduct();
	});

	$('#ALL').click(function () {
		loadProduct();
	});

	function btnFilter(kategori){
		$("#product-grid").html('');
		$.ajax({
			method: "post",
			url : "getFilter.php",
			data : `idx=${kategori}`,
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

						var newElementDetail = $('<button type="submit" id="btnDetail" style="width: 99%; height:100%; background-color: red; color: white; transform: translateY(-100%)">Show Detail</button>');
						newElementDetail.on("click", {"idx": isiProduct[index][0], "nama": isiProduct[index][1]}, fungsiBtnDetail);
						$("#product-button"+isiProduct[index][0]).append(newElementDetail);

						var newElementWish = $('<button type="submit" id="btnWish" style="width: 99%; height:100%; background-color: red; color: white; transform: translateY(-100%)">Add to Wishlist</button>');
						newElementWish.on("click", {"idx": isiProduct[index][0], "nama": isiProduct[index][1]}, fungsiBtnWish);
						$("#product-button"+isiProduct[index][0]).append(newElementWish);
					}
				} else {
					$("#product-grid").append("<h3> Data yang Anda Cari Belum Tersedia untuk Saat Ini!</h3>");
				}
			}
		})
	}

	function fungsiBtnWish(e){
		var index = e.data.idx;
		$.ajax({
			method: "post",
			url : "tambahWishlist.php",
			data : `idx=${index}`,
			success : function(res){
				var detailWish = JSON.parse(res);
				alert(detailWish);
			}
		});

		e.preventDefault;
	}

	$("#form-Search").click(function (e) {
		e.preventDefault();
		$("#product-grid").html('');

		$.ajax({
			method: "post",
			url : "search.php",
			data : $("#form-Search").serialize(),
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

						var newElementDetail = $('<button type="submit" id="btnDetail" style="width: 99%; height:100%; background-color: red; color: white; transform: translateY(-100%)">Show Detail</button>');
						newElementDetail.on("click", {"idx": isiProduct[index][0], "nama": isiProduct[index][1]}, fungsiBtnDetail);
						$("#product-button"+isiProduct[index][0]).append(newElementDetail);

						var newElementWish = $('<button type="submit" id="btnWish" style="width: 99%; height:100%; background-color: red; color: white; transform: translateY(-100%)">Add to Wishlist</button>');
						newElementWish.on("click", {"idx": isiProduct[index][0], "nama": isiProduct[index][1]}, fungsiBtnWish);
						$("#product-button"+isiProduct[index][0]).append(newElementWish);
					}
				} else {
					$("#product-grid").append("<h3> Coba kata kunci lainnya!</h3>");
				}
			}
		})
	})

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

	function loadProduct(){
		$("#product-grid").html('');
		$.ajax({
			method: "post",
			url : "getAllProduct.php",
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

						var newElementDetail = $('<button type="submit" id="btnDetail" style="width: 99%; height:100%; background-color: red; color: white; transform: translateY(-100%)">Show Detail</button>');
						newElementDetail.on("click", {"idx": isiProduct[index][0], "nama": isiProduct[index][1]}, fungsiBtnDetail);
						$("#product-button"+isiProduct[index][0]).append(newElementDetail);

						var newElementWish = $('<button type="submit" id="btnWish" style="width: 99%; height:100%; background-color: red; color: white; transform: translateY(-100%)">Add to Wishlist</button>');
						newElementWish.on("click", {"idx": isiProduct[index][0], "nama": isiProduct[index][1]}, fungsiBtnWish);
						$("#product-button"+isiProduct[index][0]).append(newElementWish);
					}
				} else {
					$("#product-grid").append("<h3> Belum Ada Barang Tersedia! </h3>");
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

	function fungsiBtnDetail(e){
		var idxBtnDetail = e.data.idx;
		window.location.href = `detailLogin.php?idx=${idxBtnDetail}`;
	}

	$('#formDetail').submit(function(e){
		$.ajax({
			method : "post",
			url : "addToCart.php",
			data : $("#formDetail").serialize(),
			success : function(res) {
				alert("berhasil ditambahkan");
			}
		});
		e.preventDefault();
	});
	
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
					if(index == detail.length-1){
						$("#formDetail").append(`
							&nbsp; &nbsp; &nbsp;
							Jumlah : <input type="number" name="count" value="1" min="1"> <br/>
							<br/> &nbsp; &nbsp; 
							<button type="submit" name="btnAdd" style="background-color:red; color:white; width:245px">Add To Cart</buton>
						`);
					}
				}
			}
		})
	}

	function add() {
		// $("#formBtn").append(`

		// `)
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