let varians = {};
let variansedit = {};

function tambahVarianEdit() { 
    let idbaju = $('#editIdProduk').val();
    let kodeukuranproduk = $("#editukuranproduk").val();
    let ukuranproduk = $("#editukuranproduk option:selected").text();
    let warna = $("#editwarna option:selected").text();
    let kodewarnaproduk  = $("#editwarna").val();
    let hargaproduk  = $("#edithargaproduk").val();
    let stokProduk   = $("#editstokProduk").val();
    if (ukuranproduk + warna in varians) {
        alert('ukuran dan warna sudah ada');
        // $(".varianMessage").html(
        //     `<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //             <span aria-hidden="true">&times;</span>
        //             <span class="sr-only">Close</span>
        //         </button>
        //         <strong>PENTING!</strong> Varian Sudah Ada
        //     </div>`
        // );
        // $(".varianMessage").slideDown();
    } else {
        // id_baju, harga, stok, id_warna, id_ukuran
        let data = [
            {name: 'id_baju'    , value: idbaju},
            {name: 'harga'      , value: hargaproduk},
            {name: 'stok'       , value: stokProduk},
            {name: 'id_warna'   , value: kodewarnaproduk},
            {name: 'id_ukuran'  , value: kodeukuranproduk},
            {name:  'tambahvarianedit', value:''}
        ];
        // AJAX UNTUK INSERT
        // AJAX INI UNTUK DAPETIN ID VARIAN
        $.ajax({
            type: "POST",
            url: "ajax/edit-ajax.php",
            data: data,
            success: function (response) {
                let data = JSON.parse(response);
                let dom  = `    <tr>
                                            <td>${ukuranproduk} 
                                            </td>
                                            <td>${warna}</td>
                                            <td><input value="${hargaproduk}" type="number" name="hargaproduk" class="form-control" placeholder="Masukkan Harga" aria-describedby="hargaprodukHint"></td>
                                            <td><input value="${stokProduk}" type="number" name="stokProduk" class="form-control" placeholder="Masukkan Stok" aria-describedby="stokProdukHint"></td>
                                            <td>
                                                <button type="button" onclick="hapusVarianEdit(this,'${ukuranproduk+warna}')" class="btn-sm btn btn-danger">
                                                    <i class="fa fa-trash fa-sm" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" onclick="submitVarianEdit(this,'${ukuranproduk+warna}')" class="btn-sm btn btn-info">
                                                    <i class="far fa-save"></i>
                                                </button>
                                                <input type="hidden" name="ideditvarian" value="${data.inserted}">
                                            </td>
                                    
                                    </tr>`;
               
                variansedit[ukuranproduk + warna] = true;
                $(".editisiVarian").append(dom);
                alert("success");
            }
        });
    }
}
function tambahVarian() { 
    let kodeukuranproduk = $("#ukuranproduk").val();
    let ukuranproduk = $("#ukuranproduk option:selected").text();
    let warna = $("#warna option:selected").text();
    let kodewarnaproduk  = $("#warna").val();
    let hargaproduk  = $("#hargaproduk").val();
    let stokProduk   = $("#stokProduk").val();
    if (ukuranproduk + warna in varians) {
        $(".varianMessage").html(
            `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>PENTING!</strong> Varian Sudah Ada
            </div>`
        );
        $(".varianMessage").slideDown();
    } else {
        let dom = ` <tr>
                        <td>${ukuranproduk} <input type="hidden" name="kodeukuranproduk[]" value="${kodeukuranproduk}">
                        </td>
                        <td>${warna} <input type="hidden" name="warna[]" value="${kodewarnaproduk}"</td>
                        <td><input value="${hargaproduk}" type="number" name="hargaproduk[]" id="hargaproduk" class="form-control" placeholder="Masukkan Harga" aria-describedby="hargaprodukHint"></td>
                        <td><input value="${stokProduk}" type="number" name="stokProduk[]" id="stokProduk" class="form-control" placeholder="Masukkan Stok" aria-describedby="stokProdukHint"></td>
                        <td>
                            <button type="button" onclick="hapusVarian(this,'${ukuranproduk+warna}')" class="btn-sm btn btn-primary">
                                <i class="fa fa-trash fa-sm" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
        `;
        varians[ukuranproduk + warna] = true;
        $(".isiVarian").append(dom);
        $(".varianMessage").slideUp(); // Menghilangkan Varian Message (Error message yang dikeluarin di line 19)
    }
}
function updatebaju() { 
    let idbaju = $('#editIdProduk').val();
    var data = $('#formnya').serializeArray();
    // data = [
    //     {name:"nama", value:"Baju KOKO"},
    //     {name:"deskripsi", value:"Baju KOKO"}
    // ]; serialize array membuat seperti ini
    data.push({name:'update', value:idbaju});

    $.ajax({
        type: "POST",
        url: "ajax/edit-ajax.php",
        data: data,
        success: function (response) {
        

        }
    });
 }
function hapusVarian(element, varianData){
    delete varians[varianData];
    $(".varianMessage").slideUp(); // Menghilangkan Varian Message (Error message yang dikeluarin di line 19)
    $(element).parent().parent().remove();
}
function ajaxLoadEdit(idbaju){
    var data = [{name: 'load', value: idbaju}];
    $.ajax({
        type: "POST",
        url: "ajax/edit-ajax.php",
        data: data,
        success: function (response) {
            variansedit = {};
            let {baju, varian} = JSON.parse(response);
            // Baju = Object, Varian = Array of Varian

            $('#editIdProduk').val(idbaju);
            $("#editnamaproduk").val(baju.NAMA);
            $("#editkategori").val(baju.ID_KATEGORI);
            $('#editdeskripsiproduk').val(baju.DESKRIPSI);
            if (baju.gambar!==null) {                
                let gambars = baju.gambar.split('@');
                let domGambar = "";
                gambars.forEach(gambar => {
                    domGambar += `
                        <div class="col-4">
                            <div style="background-image:url('./uploads/produk/${idbaju}/${gambar}')" class="ratio69 border div-image rounded" placeholder-image="default"></div>
                        </div>
                    `;
                });
                $("#gambarLamaEdit").html(domGambar);
            }
            

            let dom = '';
            varian.forEach(e => {
                dom += `    <tr>
                                    <td>${e.UKURAN} 
                                    </td>
                                    <td>${e.WARNA}</td>
                                    <td><input value="${e.HARGA}" type="number" name="hargaproduk" class="form-control" placeholder="Masukkan Harga" aria-describedby="hargaprodukHint"></td>
                                    <td><input value="${e.STOK}" type="number" name="stokProduk" class="form-control" placeholder="Masukkan Stok" aria-describedby="stokProdukHint"></td>
                                    <td>
                                        <button type="button" onclick="hapusVarianEdit(this,'${e.UKURAN+e.WARNA}')" class="btn-sm btn btn-danger">
                                            <i class="fa fa-trash fa-sm" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" onclick="submitVarianEdit(this,'${e.UKURAN+e.WARNA}')" class="btn-sm btn btn-info">
                                            <i class="far fa-save"></i>
                                        </button>
                                        <input type="hidden" name="ideditvarian" value="${e.VARIAN}">
                                    </td>
                            </tr>
                `;
            });
            variansedit[ukuranproduk + warna] = true;
        $(".editisiVarian").html(dom);
            $('#editProductModal').modal('show');

        }
    });
}

function submitVarianEdit(btn,varianData) { 
    // siapin data

    let data = [
        { name:'hargaproduk', value: $(btn).parent().parent().find('[name="hargaproduk"]').val()},
        { name:'stokProduk', value: $(btn).parent().parent().find('[name="stokProduk"]').val()},
        { name:'ideditvarian', value: $(btn).parent().parent().find('[name="ideditvarian"]').val()},
        { name:'editVarian', value: '1'}
    ];
    $.ajax({
        type: "POST",
        url: "ajax/edit-ajax.php",
        data: data,
        success: function (response) {
            
            let data = JSON.parse(response);
            if (data.status) {
                alert('success');
            } else {
                alert('gagal');
            }
        }
    });

    

    // $(".varianMessage").slideUp(); // Menghilangkan Varian Message (Error message yang dikeluarin di line 19)
 }
 function hapusVarianEdit(btn,varianData) { 
    // siapin data

    let data = [
        { name:'ideditvarian', value: $(btn).parent().parent().find('[name="ideditvarian"]').val()},
        { name:'hapusVarian', value: '1'}
    ];
    $.ajax({
        type: "POST",
        url: "ajax/edit-ajax.php",
        data: data,
        success: function (response) {
            
            let data = JSON.parse(response);
            if (data.status) {
                alert('success');
                // ui
                delete variansedit[varianData];
                $(btn).parent().parent().remove();
            } else {
                alert('gagal');
            }
        
        }
    });

    
    // ui
    // delete variansedit[varianData];
    // $(element).parent().parent().parent().remove();


    // $(".varianMessage").slideUp(); // Menghilangkan Varian Message (Error message yang dikeluarin di line 19)
 }
$(document).ready( function () {
    $('#tableProduk').DataTable();
} );
