<?php
    include('conn.php');
    session_start();
    if(isset($_POST["bayar"])){
        $totaltrans = $_SESSION["total"];
        $user = $_SESSION["userid"];
        $firstname = $_POST["fn"];
        $lastname = $_POST["ln"];
        $alamat = $_POST["alamat"];
        $notlp = $_POST["notlp"];
        $provinsi = $_POST["provinsi"];
        $kodepos = $_POST["kodepos"];
        $nameoncard = $_POST["nameoncard"];
        $ccnum = $_POST["ccnum"];
        $querycariuser = "SELECT * FROM users WHERE ID_USER='$user'";
        $resp = mysqli_query($conn , $querycariuser);
        $idus = 0;
        while ($row = mysqli_fetch_assoc($resp)) {
            $idus = $row["ID_USER"];
        }
        //Generate kode
        $select = "SELECT * FROM htrans";
        $reselect = mysqli_query($conn,$select);
        $count = mysqli_num_rows($reselect);
        $idhtrans = 'B00'.$count;
        //insert ke htrans
        $queryinsert = "INSERT INTO htrans VALUES('$idhtrans',$idus,$totaltrans,SYSDATE(),'BELUM',0,'$alamat')";
        $re = mysqli_query($conn , $queryinsert);
        //GENERATE KODE TRANS
        $querykode = "SELECT * FROM dtrans";
        $ress = mysqli_query($conn , $querykode);
        $code = mysqli_num_rows($ress);
        //insert ke dtrns
        $querymasukinid = "SELECT * FROM keranjang";
        $rescart = mysqli_query($conn , $querymasukinid);
        while($row = mysqli_fetch_assoc($rescart)){
            $idbarang = $row["ID_BARANG"];
            $jumlahbarang = $row["JUMLAH_BARANG"];
            $jumlahdtrans = $jumlahbarang * $row["HARGA_BARANG"];
            $Q = "INSERT INTO dtrans VALUES('$idhtrans','$code',$idbarang,$jumlahbarang,$jumlahdtrans)";
            $r = mysqli_query($conn , $Q);
        }
        header("Location: tagihan.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>
    <!-- Required meta tags always come first -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Checkout - One Step Checkout , Responsive Bootstrap 4 template , bootstrap 4 starter template, bootstrap4 template, checkout template">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" lang="en" content="Checkout Bootstrap 4 pricing template , Responsive and Modern HTML5 Template made from bootstrap 4.">
    <meta name="keywords" lang="en" content="pricing template, bootstrap 4 template,bootstrap 4 checkout template, responsive bootstrap 4 template, bootstrap 4, bootstraping, bootstrap4, oribitthemes">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <meta name="description" content="">
    <!--Font Awesome-->
    <link rel="stylesheet" href="dist/font-awesome/css/font-awesome.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.min.css">
    <!--[if IE]>
      <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie9.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
    <![endif]-->
    <!--[if lt IE 9]>
      <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie8.min.css" rel="stylesheet">
    <![endif]-->
</head>

<body style="border: 1px dotted black; margin: 0; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">
    <main id="main" role="main">
        <section id="checkout-banner">
            <div class="container py-5 text-center">
                <i class="fa fa-credit-card fa-3x text-light"></i>
                <h2 class="my-3">Checkout form</h2>
                <p class="lead">Happy Shopping with Sun Shop :)</p>
            </div>
        </section>
        <section id="checkout-container">
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Your cart</span>
                            <span class="badge badge-secondary badge-pill">
                            <?php
                                $user = $_SESSION["username"];
								$querystring = "SELECT * FROM KERANJANG K , USERS U WHERE U.NAMA='$user' AND K.ID_USER = U.ID_USER";
								$res = mysqli_query($conn , $querystring);
								echo mysqli_num_rows($res);
							?>
                            </span>
                        </h4>
                        <ul class="list-group mb-3" style="width: 500px">
                            <?php
                                $us = $_SESSION["username"];
                                $queryselect = "SELECT DISTINCT K.SIZE , K.ID_KERANJANG , K.ID_USER , K.ID_BARANG , K.JUMLAH_BARANG , K.HARGA_BARANG , U.ID_USER , G.LINK_GAMBAR , B.NAMA
                                FROM keranjang K , users U , baju B , gambar G
                                WHERE U.NAMA = '$us' AND K.ID_USER=U.ID_USER AND G.ID_BAJU = K.ID_BARANG AND B.ID = K.ID_BARANG AND B.ID = G.ID_BAJU
                                GROUP BY K.SIZE , K.ID_KERANJANG , K.ID_USER , K.ID_BARANG , K.JUMLAH_BARANG , K.HARGA_BARANG , B.NAMA";
                                $res = mysqli_query($conn , $queryselect);
                                while($row = mysqli_fetch_assoc($res)){
                                    echo "<li class='list-group-item d-flex justify-content-between'>
                                            <div><h6 class='my-0'>".$row["NAMA"]." x ".$row["JUMLAH_BARANG"]."</h6></div>
                                            <span class='text-muted'>Rp".$row["HARGA_BARANG"]."</span>
                                    </li>";
                                }                            
                            ?>
                            <li class='list-group-item d-flex justify-content-between'>
                                <div><h6 class='my-0'>Shipping</h6></div>
                                <span class='text-muted'>Rp<?=$_SESSION["shipping"]?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (IDR)</span>
                                <strong>Rp<?=$_SESSION["total"]?></strong>
                            </li>
                        </ul>
                    <div class="col-md-8 order-md-1" style="width: 500px">
                        <h4 class="mb-3" style="width: 500px">Billing address</h4>
                        <form class="needs-validation" method="post">
                            <div class="row" style="width: 500px">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="" value="" name="fn">
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3" style="width: 500px">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="" value="" name="ln">
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3" style="width: 465px">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St" name='alamat' required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="mb-3" style="width: 465px">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="tel" class="form-control" id="phoneNumber" name='notlp' required>
                                <div class="invalid-feedback">
                                    Please enter your phone number.
                                </div>
                            </div>

                            <div class="row" style="width: 465px">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country</label>
                                    <select class="custom-select d-block w-100" id="country" disabled>
                                        <!-- <option value="">Choose...</option> -->
                                        <option value='Indonesia'>Indonesia</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">Province</label>
                                    <select class="custom-select d-block w-100" id="state" name="provinsi" required>
                                        <?php
                                            $queryprovinsi = "SELECT * FROM PROVINCES";
                                            $respon = mysqli_query($conn , $queryprovinsi);
                                            while ($row = mysqli_fetch_assoc($respon)) {
                                                echo "<option value='".$row["nama_provinsi"]."'>".$row["nama_provinsi"]."</option>";
                                            }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" id="zip" placeholder="" name="kodepos" required>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <hr class="mb-4">
                            <button class="btn btn-primary btn-lg btn-block" name="bayar" type="submit" style="width: 465px">
                                <i class="fa fa-credit-card"></i> Continue to checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">Made with
            <i class="fa fa-heart"></i> By
            <a target="_blank" title="sunShopCheckOut">Sun Shop</a> &copy;
            <span id="currentYear"></span> All Rights Reserved.
        </p>
    </footer>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="dist/jquery/jquery.min.js"></script>
    <script src="dist/popper/popper.min.js" integrity=""></script>
    <script src="dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.min.js"></script>
</body>

</html>