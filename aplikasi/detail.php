<?php
include("conn.php");
session_start();

$idx="";
if (isset($_POST['Logout'])) {
    header('location:index.php');
    unset($_SESSION['username']);
}

if(isset($_GET['idx'])){
    $idx = $_GET['idx'];
    // echo "<script>alert($idx); </script>";
} else {
    // echo "<script>alert('none'); </script>";
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

	.carousel-item .div-image{
		padding-bottom: calc(100% * calc(6 / 9)) !important;
		background-repeat: no-repeat;
		background-size: contain;
		background-color: gainsboro;
		background-position: center;
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
								<li><a href="index.php" class="actived">Home</a></li>
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

	<form id="formShadow">
        <input type="hidden" value="<?= $idx ?>" name="idx">
    </form>

	<!-- New Arrivals -->

	<div class="new_arrivals" style="margin-top:185px;">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<!-- <div class="section_title new_arrivals_title">
						<h2>New Arrivals</h2>
					</div> -->
				</div>
			</div>
			<div class="row align-items-center">
				<div class="offset-3 col-6 text-center">
					<div id="slideshow-container" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							
						</div>
						<a class="carousel-control-prev" href="#slideshow-container" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#slideshow-container" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
                    <!-- <div class="detail-content">
                        <div class="content-header">
                            <h2 id="modalHeader"></h2>
                        </div> <br/>
                        <div id="modalBody">
                            <div class="slideshow-container" id="slideshow-container" style="height: 210px;"></div>
                            <p id="deskripsi" style="transform: translateY(110px)"></p>
                            <p id="harga" style="transform: translateY(110px)"></p>
                            
                        </div>
                    </div> -->
				</div>
			</div>
			<div class="row">
				<form id="formDetail" class="col-6 offset-3">
				
				</form>
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
		<!-- <div class="container">
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
		</div> -->
		<!-- <div id="shadow" style="height:<?= $geser ?>; background-color:white"></div> -->
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
		loadDetail();
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

	function loadDetail(e){
        var idxBtnDetail = "";
        $.ajax({
			method : "post",
			url : "getDeskripsi.php",
			data : $("#formShadow").serialize(),
			success : function (r) {
                var detail = JSON.parse(r);
                idxBtnDetail = detail['id'];

				$("#deskripsi").append(`
					&nbsp; &nbsp; &nbsp;
					deskripsi : ${detail["deskripsi"]}
                `);
                
                ambilSemuaGambar(idxBtnDetail);
                addRbSize(idxBtnDetail);
                addRbColor(idxBtnDetail);
                $("#formDetail").append('<input type="hidden" name="id" value="'+idxBtnDetail+'">');
			}
		})	
    }
    
	$('#formDetail').submit(function(e){
        e.preventDefault();
        alert("silahkan login dulu!");
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
					$("#slideshow-container .carousel-inner").append(`
						<div class="carousel-item ${(index===0) ? 'active': ''}">
							<div class='div-image' style="background-image:url('${srcGambar}');"></div>
						</div>
					`);
						// <div class="mySlides1" style="transform:translateY(100px)">
						// 	<img src=${srcGambar} style="width:150px; height:200px;">
						// </div>
				}
				$('#slideshow-container').carousel({
					interval: 2000
				});
				// $("#slideshow-container").append(`
				// 	<a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
				// 	<a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
				// `);
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
							<button style="cursor:pointer;" type="submit" name="btnAdd" class="btn btn-primary w-100">Add To Cart</buton>
						`);
					}
				}
			}
		})
    }

	var slideIndex = [1,1];
	var slideId = ["mySlides1"]
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