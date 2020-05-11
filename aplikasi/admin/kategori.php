<?php 
    session_start();
    include('conn-admin.php');
    $_SESSION['sideNav'] = [
        'kategori' => true,
    ];
    $_SESSION['activeTree'] = [
        "master" => true
    ];
    if (isset($_POST['addKategori'])) {
        $namaKategori=$_POST["namaKategori"];
        $insertkategori = executeNonQuery("INSERT into kategori(NAMA_KATEGORI)
        values ('$namaKategori')");
        $status = $insertkategori['status'];
        $message = ($insertkategori['status']) ? "Sukses" : "Gagal";
        $message .= ' menambahkan kategori';
    }
    if (isset($_POST['delete'])) {
        // $deletekategori = executeNonQuery("DELETE from kategori where ID_KATEGORI=".$_POST['delete']);
        $deletekategori = executeNonQuery("UPDATE kategori set STATUS=0 where ID_KATEGORI=".$_POST['delete']);
        $status = $deletekategori['status'];
        $message = ($status) ? "Sukses" : "Gagal";
        $message .= ' menghapus kategori'; 
        // var_dump($_POST['delete']);
        // die;
    }

    $ambilkategori = executeQuery("SELECT * from kategori where STATUS = 1");
?>
<!-- Head -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin Sunshop</title>

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


        <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog" aria-labelledby="AddKategoriLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddKategori" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nama Kategori</label>
                                <input required type="text" name="namaKategori" id="namaKategori" class="form-control" placeholder="Masukan nama Kategori" aria-describedby="namaKategoriHint">
                                <small id="namaKategoriHint" class="text-muted">Pastikan nama Kategori benar</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="formAddKategori" class="btn btn-primary" id="addKategori" name="addKategori">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Admin Sunshop</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Admin Sunshop</li>
                                </ol>
                            </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->
                    <?php if (isset($message) && !empty($message)) {?>
    
                        <div class="alert alert-<?= ($status) ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong><?= $message ?></strong> 
                        </div>
                    <?php } ?>
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKategoriModal">
                    Add Kategori
                    </button>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=0; $i < count($ambilkategori); $i++) { ?>
                                <tr>
                                    <td><?= $ambilkategori[$i]['NAMA_KATEGORI'] ?></td>
                                    <td>
                                        <form method="POST">
                                            <button name="delete" value="<?= $ambilkategori[$i]['ID_KATEGORI']?>" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash fa-sm" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                           <?php }?>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>
    </div>



    <!-- REQUIRED SCRIPTS -->
    <?php include('page-part-admin/admin-required-script.php'); ?>
    
    <!-- Optional Scripts -->
    
</body>
</html>