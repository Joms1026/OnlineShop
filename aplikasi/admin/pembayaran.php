<?php 
    session_start();
    $_SESSION['sideNav'] = [
        'pembayaran' => true,
    ];
    $_SESSION['activeTree'] = [
        "master" => true
    ];
?>
<!-- Head -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Master Pembayaran</title>

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

        <!-- Page Content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Master Pembayaran</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Master</a></li>
                                <li class="breadcrumb-item active">Pembayaran</li>
                                </ol>
                            </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->
                    <section class="content">
                        <div class="container-fluid">
                            <?php 
                            // Ganti halaman mu disini 
                            ?>
                            <div>Disini ya Koko Erland</div>
                        </div>
                    </section>
                </div>
            </section>

        </div>
    </div>



    <!-- REQUIRED SCRIPTS -->
    <?php include('page-part-admin/admin-required-script.php'); ?>
    
    <!-- Optional Scripts -->
    
</body>
</html>