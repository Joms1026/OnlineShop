let varians = {};

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

function hapusVarian(element, varianData){
    delete varians[varianData];
    $(".varianMessage").slideUp(); // Menghilangkan Varian Message (Error message yang dikeluarin di line 19)
    $(element).parent().parent().remove();
}