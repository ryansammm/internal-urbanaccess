// $("#layanan").on("change", function () {
//     persyaratan = "";
//     persyaratanRegistrasi = "";
//     if ($(this).val() != "") {
//         // ajax get kecepatan
//         $.ajax({
//             url: "/kecepatan/get/" + $(this).val(),
//             method: "get",
//         }).done(function (data) {
//             var optionKecepatan = "";
//             optionKecepatan = '<option value=""> -- Pilih Kecepatan -- </option>';
//             for (let index = 0; index < data.length; index++) {
//                 const element = data[index];
//                 optionKecepatan +=
//                     '<option value="' +
//                     element.idLayananinternetdetail +
//                     '">' +
//                     element.kecepatan +
//                     " Mbps</option>";
//             }
//             $("#kecepatan").html(optionKecepatan);
//             $("#kecepatan").prop("disabled", false);
//         });
//     }
// });

$(document).on('keyup', '.number', function (event) {


    // skip for arrow keys
    if (event.which >= 37 && event.which <= 40) return;

    // format number
    $(this).val(function (index, value) {
        return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
});

$('.vendor').on('click', function () {
    var codeMinat = $(this).attr("data-id");
    $.ajax({
        url: "/request-survey-vendor/getInput/" + codeMinat,
        method: "get",
    }).done(function (data) {
        // $('.idVendor').html(parseInt(data.data.biayaregistrasi).toLocaleString());
        var listVendor = '';
        for (let index = 0; index < data.length; index++) {
            const element = data[index];
            listVendor += '<div class="col-6"><div class="card-body form-group border border-1 rounded"><h5>' + element.namaVendor + '</h5><div class="row"><div class="col"><label for="first-name-vertical">Tanggal Keluar Hasil Survey</label><input type="date" class="form-control" name="tanggalHasil-' + element.idVendor + '" required></div><div class="col"><label for="first-name-vertical">Status</label><select name="hasil-' + element.idVendor + '" id="" class="form-select" required><option value="1">Tercover</option><option value="2">Tidak Tercover</option></select></div></div><div class="row"><div class="col"><label for="first-name-vertical">Jarak</label><div class="input-group "><input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="jarak-' + element.idVendor + '" required><span class="input-group-text">m</span></div></div><div class="col"><label for="first-name-vertical">Biaya Instalasi</label><div class="input-group"><span class="input-group-text">Rp.</span><input type="text" class="form-control number" name="biayaInstalasi-' + element.idVendor + '" required></div></div></div><div class="row"><div class="col"><label for="first-name-vertical">Keterangan</label><textarea name="keterangan-' + element.idVendor + '" id="" class=" form-control"></textarea></div></div></div></div>';
            $('.anyar').html(listVendor)


        }
        $('.formweh').prop('action', '/input-hasil-soft-survey/' + codeMinat + '/update');
    });

})