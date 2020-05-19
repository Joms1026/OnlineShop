<?php 
    function activeMenu($menuString){
        //  print_r( $_SESSION);
        if (isset($_SESSION['sideNav'][$menuString]) && $_SESSION['sideNav'][$menuString] == true) {
            echo 'active';
        }
    }
    function activeTree($menuString){
        if (isset($_SESSION['activeTree'][$menuString]) && $_SESSION['activeTree'][$menuString] == true) {
            echo 'menu-open';
        }
    }
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">Admin Sunshop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="vendor-admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">Admin Sunshop</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="http://localhost/onlineShop/aplikasi/admin/dashboard.php" class="nav-link <?php activeMenu('dashboard'); ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-treeview <?php activeTree('master'); ?>">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Master
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <?php $base = ""; ?>
                    <li class="nav-item">
                        <a href="<?=$base?>kategori.php" class="nav-link <?php activeMenu('kategori'); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=$base?>produk.php" class="nav-link <?php activeMenu('produk'); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=$base?>customer.php" class="nav-link <?php activeMenu('customer'); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Customer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=$base?>pembayaran.php" class="nav-link <?php activeMenu('pembayaran'); ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pembayaran</p>
                        </a>
                    </li>
                </ul>
                <li class="nav-item has-treeview <?php activeTree('report'); ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Report
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=$base?>penjualan.php" class="nav-link <?php activeMenu('penjualan'); ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Penjualan</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link <?php activeMenu('dashboard'); ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>