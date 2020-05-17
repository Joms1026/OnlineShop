<?php 
    session_start();
    include("./conn-admin.php");
    $_SESSION['sideNav'] = [
        'customer' => true,
    ];
    $_SESSION['activeTree'] = [
        "master" => true
    ];
    if (isset($_POST['delete'])) {
        $hapus = $_POST['delete'];
        $hapusbarang = executeNonQuery("UPDATE users set STATUS = 1-STATUS where ID_USER=$hapus");
    }
?>
<!-- Head -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Sunshop</title>

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
                                <h1 class="m-0 text-dark">MASTER CUSTOMER</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Master</a></li>
                                <li class="breadcrumb-item active">Customer</li>
                                </ol>
                            </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->
                    <section class="content">
                        <div class="container-fluid">

                            <?php $ambildatacust = executeQuery("
                                SELECT ID_USER,NAMA,EMAIL_USER as EMAIL, STATUS
                                FROM users
                                WHERE ROLE =0;
                            ") ;
                            
                            ?>
                            <table class="table" id="tableProduk">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i=0; $i <count($ambildatacust) ; $i++) { ?>
                                        <tr>
                                            <td><?=$ambildatacust[$i]['NAMA']?></td>
                                            <td><?=$ambildatacust[$i]['EMAIL']?></td>
                                            <td><?= ($ambildatacust[$i]['STATUS']=='1') ?  'Aktif': 'Nonaktif'; ?></td>
                                            <td>
                                                <form method="POST">
                                                    <button name="delete" value=<?= $ambildatacust[$i]['ID_USER']?> class="btn btn-<?= ($ambildatacust[$i]['STATUS']=='1') ? 'danger' : 'primary'; ?> btn-sm" role="button">
                                                    <?php if($ambildatacust[$i]['STATUS']=='1') {?>
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    <?php } else{?>
                                                        <i class="fas fa-undo" aria-hidden="true"></i>
                                                    <?php }?>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php } ?>
                                </tbody>
                            </table>
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