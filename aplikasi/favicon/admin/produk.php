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
        $insertbarang = executeNonQuery("INSERT INTO baju(NAMA, DESKRIPSI, STATUS, ID_KATEGORI) values 
        ('$namaproduk','$deskripsiproduk',1, $kategori)");
        $ambilID = executeQuery("SELECT max(ID) as id from baju")[0]['id'];
        $kodeukuranProduk = [
            'produk1' => "123",
            'produk2' => "224",
        ];
        $kodeukuranProduk = [
            0 => "123",
            1 => "224",
        ];
        
        foreach ($_POST['kodeukuranproduk'] as $key => $value) {
            $ukuran      = $_POST['kodeukuranproduk'][$key];
            $warna       = $_POST['warna'][$key];
            $stok        = $_POST['stokProduk'][$key];
            $hargaProduk = $_POST['hargaproduk'][$key];

            $insertvarians = executeNonQuery("INSERT into varian_baju(ID_BAJU, HARGA, STOK, ID_WARNA, ID_UKURAN) values
            ($ambilID, $hargaProduk, $stok, '$warna', '$ukuran')");
        }
        
        
        foreach ($_FILES['uploadgambar']['name'] as $key => $img) {
            
            // echo json_encode($_FILES['uploadgambar'][$key]);

            if($_FILES['uploadgambar']['size'][$key] > 0 && $_FILES['uploadgambar']['error'][$key] == 0){
                $target_dir = "uploads/produk/$ambilID";

                if (!file_exists( $target_dir)) {
                    mkdir( $target_dir, 0777, true);
                }
                // $target_file = $target_dir . basename($_FILES['uploadgambar']["name"][$key]);
                $imageFileType = strtolower(pathinfo(basename($_FILES['uploadgambar']["name"][$key]),PATHINFO_EXTENSION));

                $filename = $ambilID.uniqid().".".$imageFileType;
                $target_file = $target_dir."/" . $filename;
                $uploadOk = 1;

                if (move_uploaded_file($_FILES['uploadgambar']["tmp_name"][$key], $target_file)) {
                    # Buat ExecuteNonQuery Insert nama gambar $filename
                    $insertgambar = executeNonQuery("INSERT into gambar(LINK_GAMBAR,ID_BAJU) values
                    ('$filename',$ambilID)");
                    // echo "The file ". basename( $_FILES['uploadgambar']["name"][$key]). " has been uploaded.";
                } else {
                    
                }
            }
        }
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
                                  <label for="kategori">Kategori</label>
                                  <select class="form-control" name="kategori" id="kategori">
                                      <?php $ambilkategori = executeQuery("SELECT ID_KATEGORI,NAMA_KATEGORI from kategori where STATUS=1");
                                      for ($i=0; $i < count($ambilkategori); $i++) { ?>
                                          
                                          <option value="<?=$ambilkategori[$i]['ID_KATEGORI']?>">
                                          <?= $ambilkategori[$i]['NAMA_KATEGORI']?></option>
                                    <?php  }
                                      ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="deskripsiproduk">Deskripsi Produk</label>
                                  <textarea class="form-control" name="deskripsiproduk" id="deskripsiproduk" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="uploadgambar">Upload Gambar</label>
                                  <input type="file" multiple class="form-control-file" name="uploadgambar[]" id="uploadgambar" placeholder="uploadgambar" aria-describedby="uploadgambarHint">
                                  <small id="uploadgambarHint" class="form-text text-muted">Pastikan format gambar benar</small>
                                </div>
                            </div>
                            <hr>
                            <h4>Varian</h4>
                            <!-- Dalam 1 Row ada 12 Kolom -->
                            <div class="row"> 
                                <div class="col-3">
                                    <div class="form-group">
                                        <select class="form-control" id="ukuranproduk">
                                            <option selected disabled>Pilih Ukuran</option>
                                            <option value="TS001">XS</option>
                                            <option value="TS002">S</option>
                                            <option value="TS003">M</option>
                                            <option value="TS004">L</option>
                                            <option value="TS005">XL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <select class="form-control" id="warna" aria-describedby="warnaProdukHint">
                                            <option disabled selected>Pilih warna</option>
                                            <?php $ambilwarna = executeQuery("SELECT ID_WARNA,NAMA_WARNA from tipe_warna");
                                            for ($i=0; $i <count($ambilwarna) ; $i++) {?>
                                                <option value="<?= $ambilwarna[$i]['ID_WARNA']?>" ><?= $ambilwarna[$i]['NAMA_WARNA'] ?></option>
                                                
                                           <?php }
                                            ?>
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
                        <button type="submit" form="formAddProduk" class="btn btn-primary" id="addproduk" name="addproduk">Submit</button>
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