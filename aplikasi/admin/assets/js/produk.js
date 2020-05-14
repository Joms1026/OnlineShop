let varians = {};
let variansedit = {};

function tambahVarian() { 
    let kodeukuranproduk = $("#ukuranproduk").val();
    let ukuranproduk = $("#ukuranproduk option:selected").text();
    let warna = $("#warna option:selected").text();
    let kodewarnaproduk  = $("#warna").val();
    let hargaproduk  = $("#hargaproduk").val();
    let stokProduk   = $("#stokProduk").val();
    // console.log({ ukuranproduk, warna, hargaproduk, stokProduk }); // biar muncul di konsol
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
    // data = [
    //     {name:"nama", value:"Baju KOKO"},
    //     {name:"deskripsi", value:"Baju KOKO"},
    //     {name:'update', value:idbaju}
    // ];

    // Bentuk di ajax
    // data = [
    //     {name:"nama", value:"Baju KOKO"},
    //     {name:"deskripsi", value:"Baju KOKO"},
    //     {name:'update', value:idbaju}
    // ];
    // Bentuk di php
    // $_POST['nama'] = "ju KOK"
    // $_POST['deskripsi'] = "ju KOK"
    // $_POST['update'] = "dbaju"

    // Step pertama : Menyiapkan data yang dikirim -> sebelum ajax Js
    // Step kedua : ngerjain PHP nya -> php
    // Step ketiga : melakukan hal tertentu setelah ajax -> hasil (success) js
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
    console.log(idbaju);
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
            $('#editdeskripsi').val(baju.DESKRIPSI);

            let dom = '';
            varian.forEach(e => {
                console.log(e);
                dom += `    <tr>
                                <form class="editVarians" data-id="${e.VARIAN}">
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
                                    </td>
                                </form>
                            </tr>
                `;
            });
            variansedit[ukuranproduk + warna] = true;
        $(".editisiVarian").html(dom);
            $('#editProductModal').modal('show');

        }
    });
}
$(document).ready( function () {
    $('#tableProduk').DataTable();
} );
