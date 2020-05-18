<?php // MENGHASILKAN DATA \
    include("./conn-admin.php");
    
    $categories = executeQuery("
        SELECT k.ID_KATEGORI, k.NAMA_KATEGORI
        FROM kategori k
        WHERE k.STATUS = 1
    ");
    $datas = [];
    foreach ($categories as $key => $category) {
        $query =executeQuery("SELECT 
        date(ht.TGL_TRANS) as unix,  
        SUM(case when b.ID_KATEGORI=".$category['ID_KATEGORI']." then dt.JUMLAH_BARANG else 0 end) as penjualan
        FROM htrans ht
        LEFT OUTER JOIN dtrans dt ON ht.ID_HTRANS = dt.ID_HTRANS
        LEFT OUTER JOIN baju b ON b.ID = dt.ID_BARANG
        WHERE ht.STATUS_PEMBAYARAN='SUDAH'
        GROUP BY UNIX_TIMESTAMP(ht.TGL_TRANS)",MYSQLI_NUM);
        $datas[$category['NAMA_KATEGORI']]=$query;
    }
    echo json_encode($datas);
