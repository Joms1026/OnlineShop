<?php
    include("../conn-admin.php");
    if (isset($_POST['load'])) {
        $ambildataheader = executeQuery("
        SELECT b.*,
        CONCAT( GROUP_CONCAT(g.LINK_GAMBAR SEPARATOR '@') ) as gambar
        from baju b 
        LEFT OUTER JOIN gambar g ON g.ID_BAJU = b.ID
        where b.ID = ".$_POST['load'])[0];
        

        $ambildatadetail = executeQuery("
        SELECT tw.NAMA_WARNA AS WARNA, ts.NAMA_SIZE AS UKURAN, v.ID_VARIAN AS VARIAN, 
        v.HARGA as HARGA, v.STOK as STOK
        from varian_baju v 
        JOIN tipe_size ts ON ts.ID_SIZE = v.ID_UKURAN
        JOIN tipe_warna tw ON tw.ID_WARNA = v.ID_WARNA where v.STATUS=1 and v.ID_BAJU =".$_POST['load']);
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
    if (isset($_POST['editVarian'])) {
        $hargaproduk = $_POST['hargaproduk'];
        $stokProduk = $_POST['stokProduk'];
        $ideditvarian = $_POST['ideditvarian'];

        $updateVarian = executeNonQuery("
        UPDATE varian_baju
        SET 
        HARGA = $hargaproduk ,
        STOK = $stokProduk
        where ID_VARIAN = $ideditvarian
        ");
        echo json_encode($updateVarian);
    }
    if (isset($_POST['hapusVarian'])) {
        $ideditvarian = $_POST['ideditvarian'];

        $hapusVarian = executeNonQuery("
        UPDATE varian_baju
        SET 
        STATUS = 0
        where ID_VARIAN = $ideditvarian
        ");
        
        echo json_encode($hapusVarian);
    }
    if (isset($_POST['tambahvarianedit'])) {
        $id_baju = $_POST['id_baju'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $id_warna = $_POST['id_warna'];
        $id_ukuran = $_POST['id_ukuran'];
        
        $tambahvarian = executeNonQuery("
            INSERT into varian_baju(ID_BAJU, HARGA, STOK, ID_WARNA, ID_UKURAN)
            values ($id_baju, $harga, $stok, '$id_warna', '$id_ukuran') 
        ");
        $tambahvarian['inserted'] = executeQuery("
            SELECT MAX(ID_VARIAN) as idvarian from varian_baju where ID_BAJU = $id_baju
        ")[0]['idvarian'];

        echo json_encode($tambahvarian);
    }
    


?>