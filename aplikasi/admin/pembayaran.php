<?php 
    session_start();
    include("../conn.php");
    
    
    if (!isset($_SESSION['userid'])) {
        header('location: ../index.php');
        die();
    }
    if (!isset($_SESSION['userrole']) || $_SESSION['userrole']!=1) {
        header('location: ../index.php');
        die();
    }
    $_SESSION['sideNav'] = [
        'pembayaran' => true,
    ];
    $_SESSION['activeTree'] = [
        "master" => true
    ];
    if(isset($_POST["btnConfirm"])){
        $idh = $_POST["btnConfirm"];
        $queryupdate = "UPDATE htrans SET STATUS_PEMBAYARAN = 'SUDAH' WHERE ID_HTRANS = '$idh'";
        $ress = mysqli_query($conn , $queryupdate);
        echo "<script>alert('Pembayaran sudah dikonfirmasi')</script>";
    }
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
                            <div id="container">                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">ID HTRANS</th>
                                        <th scope="col">ID USER</th>
                                        <th scope="col">TOTAL TRANSAKSI</th>
                                        <th scope="col">TANGGAL TRANSAKSI</th>
                                        <th scope="col">STATUS PEMBAYARAN</th>
                                        <th scope="col">ALAMAT</th>
                                        <th scope="col">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablebody">
                                        <?php
                                            $queryselect = "SELECT * FROM htrans";
                                            $res = mysqli_query($conn , $queryselect);
                                            //$ctr = 0;
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                echo "<tr>
                                                <td>".$row['ID_HTRANS']."</td>
                                                <td>".$row['ID_USER']."</td>
                                                <td>".$row['TOTAL_TRANS']."</td>
                                                <td>".$row['TGL_TRANS']."</td>
                                                <td>".$row['STATUS_PEMBAYARAN']."</td>
                                                <td>".$row['ALAMAT']."</td>
                                                <td>
                                                <form method='post'>
                                                <button class='btn btn-warning' type='submit' name='btnDetail' value='".$row['ID_HTRANS']."'>Detail</button>
                                                <button class='btn btn-success' type='submit' name='btnConfirm' value='".$row['ID_HTRANS']."'>Confim</button>
                                                </form>
                                                </td>
                                                </tr>";
                                                //$ctr++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                    if(isset($_POST["btnDetail"])){
                                        echo "<h1>Detail</h1>";
                                        //echo "<script>alert('Detail')</script>";
                                        $id = $_POST["btnDetail"];
                                        $queryselect = "SELECT B.NAMA , D.JUMLAH_BARANG , D.JUMLAH_DTRANS FROM dtrans D , BAJU B WHERE ID_HTRANS = '$id' AND D.ID_BARANG = B.ID";
                                        $respon = mysqli_query($conn , $queryselect);
                                        echo"
                                        <table class='table'>
                                            <thead>
                                                <tr>
                                                <th scope='col'>NAMA BARANG</th>
                                                <th scope='col'>JUMLAH BARANG</th>
                                                <th scope='col'>SUBTOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        ";
                                        while($row = mysqli_fetch_assoc($respon)){
                                        echo
                                            "<tr>
                                                <td>".$row["NAMA"]."</td>
                                                <td>".$row["JUMLAH_BARANG"]."</td>
                                                <td>".$row["JUMLAH_DTRANS"]."</td>
                                            </tr>";
                                        }
                                        echo"
                                        </tbody>
                                        </table>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
            </section>

        </div>
    </div>



    <!-- REQUIRED SCRIPTS -->
    <?php include('page-part-admin/admin-required-script.php'); ?>
    
    <!-- Optional Scripts -->
    <script>
        // $(".confirm").submit(function(e){
        //     e.preventDefault();
        //     $.ajax({
        //         method : "post",
        //         url : "confirmpembayaran.php",
        //         data : $(".confirm").serialize(),
        //         success : function(res){
        //             alert(res);
        //         }
        //     });
        // });
    </script>
</body>
</html>