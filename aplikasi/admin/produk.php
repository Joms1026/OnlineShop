<?php 
    session_start();
    include('conn-admin.php');
    $_SESSION['sideNav'] = [
        'produk' => true,
    ];

    $_SESSION['activeTree'] = [
        "master" => true
    ];
    $cobaselect = executeQuery("SELECT * from kategori");
    if (isset($_POST['addproduk'])) {	
        // var_dump($_POST);
        $namaproduk      = $_POST['namaproduk'];
        $stokProduk      = $_POST['stokProduk'];
        $kategori        = $_POST['kategori'];
        // $uploadgambar    = $_POST['uploadgambar'];
        $deskripsiproduk = $_POST['deskripsiproduk'];
        $insertproduk    = executeNonQuery("INSERT into barang(NAMA_BARANG,
        STOK_BARANG,GAMBAR_BARANG,	
        DESKRIPSI_BARANG,ID_KATEGORI) 	
        values('$namaproduk',$stokProduk,'temp.jpg','$deskripsiproduk','$kategori')"); 	
        // print_r($insertproduk);
        // die();
    }
?>
<!-- Head -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>MASTER PRODUK</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="vendor-admin/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="vendor-admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vendor-admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Page Top Navigation -->    
        <?php include('page-part-admin/admin-top-nav.php'); ?>

        <!-- Page Side Navigation -->
        <?php include('page-part-admin/admin-side-nav.php'); ?>

        <!-- Modal -->
        
        <!-- Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="AddProdukLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddProduk" method="post" enctype="multipart/form-data">
                            <div class="col-8 offset-2">
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="namaproduk" id="namaproduk" class="form-control" placeholder="Masukan nama produk" aria-describedby="namaProdukHint">
                                    <small id="namaProdukHint" class="text-muted">Pastikan nama produk benar</small>
                                </div>
                                <div class="form-group">
                                  <label for="deskripsiproduk">Deskripsi Produk</label>
                                  <textarea class="form-control" name="deskripsiproduk" id="deskripsiproduk" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="uploadgambar">Upload Gambar</label>
                                  <input type="file" class="form-control-file" name="uploadgambar" id="uploadgambar" placeholder="uploadgambar" aria-describedby="uploadgambarHint">
                                  <small id="uploadgambarHint" class="form-text text-muted">Pastikan format gambar benar</small>
                                </div>
                            </div>
                            <hr>
                            <h4>Varian</h4>
                            <!-- Dalam 1 Row ada 12 Kolom -->
                            <div class="row"> 
                                <div class="col-3">
                                    <div class="form-group">
                                        <select class="form-control" name="ukuranproduk" id="ukuranproduk">
                                            <option selected disabled>Pilih Ukuran</option>
                                            <option>M</option>
                                            <option>L</option>
                                            <option>XL</option>
                                            <option>XXL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <select class="form-control" name="kategori" id="kategori" aria-describedby="kategoriProdukHint">
                                            <option disabled selected>Pilih Kategori</option>
                                            <option value="K001">Baju Pria</option>
                                            <option value="K002">Baju Wanita</option>
                                            <option value="K003">Baju Anak-Anak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <input type="number" name="hargaproduk" id="hargaproduk" class="form-control" placeholder="Masukkan Harga" aria-describedby="hargaprodukHint">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <input type="number" name="stokProduk" id="stokProduk" class="form-control" placeholder="Masukkan Stok" aria-describedby="stokProdukHint">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button type="button" onclick="tambahVarian();" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="varianMessage col-12" style="display: none"></div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Ukuran</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="isiVarian">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="formAddProduk" class="btn btn-primary" id="addproduk" name="addproduk">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content-wrapper">
            
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">MASTER PRODUK</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <?php // Ganti halaman mu disini 
                    // var_dump($cobaselect);?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                    Add Produk
                    </button>
                    
                </div>
            </section>
        </div>
    </div>



    <!-- REQUIRED SCRIPTS -->
    <?php include('page-part-admin/admin-required-script.php'); ?>
    <script src="./assets/js/produk.js"></script>
    <!-- Optional Scripts -->
    
</body>
</html>