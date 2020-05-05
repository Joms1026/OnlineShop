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
    $insertproduk = executeNonQuery("INSERT into barang(NAMA_BARANG,
    STOK_BARANG,GAMBAR_BARANG,
    DESKRIPSI_BARANG,ID_KATEGORI) 
    values('Baju Koko',12,'aa','Baju Perempuan',1"); 
     
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input type="text" name="namaproduk" id="namaproduk" class="form-control" placeholder="Masukan nama produk" aria-describedby="namaProdukHint">
                                <small id="namaProdukHint" class="text-muted">Pastikan nama produk benar</small>
                            </div>
                            <div class="form-group">
                                <label for="stokProduk">Stok</label>
                                <input type="number" name="stokProduk" id="stokProduk" class="form-control" placeholder="Masukkan Stok Produk" aria-describedby="stokProdukHint">
                                <small id="stokProdukHint" class="text-muted">Pastikan Jumlah Stok Benar</small>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control" name="kategori" id="kategori" aria-describedby="kategoriProdukHint">
                                    <option disabled selected hidden>Pilih Kategori</option>
                                    <option value="">Kategori2</option>
                                    <?php ?>
                                    <!-- <option> PAKAI PHP ISI PAKAI FOR </option> -->
                                </select>
                                <small id="kategoriProdukHint" class="text-muted">Pastikan kategori sesuai</small>
                            </div>
                            <div class="form-group">
                              <label for="uploadgambar">Upload Gambar</label>
                              <input type="file" class="form-control-file" name="uploadgambar" id="uploadgambar" placeholder="uploadgambar" aria-describedby="uploadgambarHint">
                              <small id="uploadgambarHint" class="form-text text-muted">Pastikan format gambar benar</small>
                            </div>
                            <div class="form-group">
                              <label for="deskripsiproduk">Deskripsi Produk</label>
                              <textarea class="form-control" name="deskripsiproduk" id="deskripsiproduk" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addproduk" name="addproduk">Add</button>
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
    
    <!-- Optional Scripts -->
    
</body>
</html>