<?php
    include("../conn-admin.php");
    if (isset($_POST['load'])) {
        $ambildataheader = executeQuery("SELECT * from baju b where b.ID = ".$_POST['load'])[0];

        $ambildatadetail = executeQuery("SELECT tw.NAMA_WARNA AS WARNA, ts.NAMA_SIZE AS UKURAN, v.ID_VARIAN AS VARIAN, 
        v.HARGA as HARGA, v.STOK as STOK
        from varian_baju v 
        JOIN tipe_size ts ON ts.ID_SIZE = v.ID_UKURAN
        JOIN tipe_warna tw ON tw.ID_WARNA = v.ID_WARNA where v.ID_BAJU =".$_POST['load']);
        $data = [
            "baju"   => $ambildataheader,
            "varian" => $ambildatadetail
        ];
        
        echo json_encode($data);
    }
    if (isset($_POST['edit'])) {
        $updateGeneral = executeNonQuery("
        UPDATE 
        SET JUDUL=''
        where ID=".$_POST['edit']);
        $updateGeneral = [
            'data' => ['baju' => true],
            'json' => ['status'=> 3]
        ];
        echo json_encode($updateGeneral);
    }
?>