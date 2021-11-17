$(document).ready(function () {
  var persyaratan = "";
  var persyaratanRegistrasi = "";

  $("#layanan").on("change", function () {
    persyaratan = "";
    persyaratanRegistrasi = "";
    if ($(this).val() != "") {
      $.ajax({
        url: "/group-layanan-persyaratan/get/" + $(this).val(),
        method: "get",
      }).done(function (data) {
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          persyaratan +=
            '<div class="col-6"><div class="form-group"><label for="first-name-vertical">' +
            element.namaPersyaratan +
            '</label><input type="file" class="form-control" name="' +
            element.idPersyaratan +
            '"></div></div>';
          persyaratanRegistrasi += element.idPersyaratan + ",";
        }
        $("#persyaratan").html(persyaratan);
        $("#persyaratanRegistrasi").val(persyaratanRegistrasi);
      });

      $.ajax({
        url: "/kecepatan/get/" + $(this).val(),
        method: "get",
      }).done(function (data) {
        var optionKecepatan = "";
        optionKecepatan = '<option value="">Pilih Kecepatan</option>';
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          optionKecepatan +=
            '<option value="' +
            element.idLayananinternet +
            '">' +
            element.kecepatan +
            " Mbps</option>";
        }
        $("#kecepatan").html(optionKecepatan);
        $("#kecepatan").prop("disabled", false);
      });
    }
  });

  var optionKabupaten = "";
  $("#provinsi").on("change", function () {
    optionKabupaten = '<option value="">Pilih Kabupaten</option>';
    if ($(this).val() != "") {
      $.ajax({
        url: "/kabupaten/get/" + $(this).val(),
        method: "get",
      }).done(function (data) {
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          optionKabupaten +=
            '<option value="' + element.id + '">' + element.name + "</option>";
        }
        $("#kabupaten").html(optionKabupaten);
        $("#kabupaten").prop("disabled", false);
      });
    }
  });

  var optionKecamatan = "";
  $("#kabupaten").on("change", function () {
    optionKecamatan = '<option value="">Pilih Kecamatan</option>';
    if ($(this).val() != "") {
      $.ajax({
        url: "/kecamatan/get/" + $(this).val(),
        method: "get",
      }).done(function (data) {
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          optionKecamatan +=
            '<option value="' + element.id + '">' + element.name + "</option>";
        }
        $("#kecamatan").html(optionKecamatan);
        $("#kecamatan").prop("disabled", false);
      });
    }
  });

  var optionKelurahan = "";
  $("#kecamatan").on("change", function () {
    optionKelurahan = '<option value="">Pilih Kelurahan</option>';
    if ($(this).val() != "") {
      $.ajax({
        url: "/kelurahan/get/" + $(this).val(),
        method: "get",
      }).done(function (data) {
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          optionKelurahan +=
            '<option value="' + element.id + '">' + element.name + "</option>";
        }
        $("#kelurahan").html(optionKelurahan);
        $("#kelurahan").prop("disabled", false);
      });
    }
  });

  $(document).ready(function () {

    var persyaratan = '';
    var persyaratanRegistrasi = '';
    $('#layanan').on('change', function () {
      persyaratan = '';
      persyaratanRegistrasi = '';
      if ($(this).val() != '') {
        $.ajax({
          url: "/group-layanan-persyaratan/get/" + $(this).val(),
          method: 'get'
        }).done(function (data) {
          for (let index = 0; index < data.length; index++) {
            const element = data[index];
            persyaratan += '<div class="col-6"><div class="form-group"><label for="first-name-vertical">' + element.namaPersyaratan + '</label><input type="file" class="form-control" name="' + element.idPersyaratan + '"></div></div>';
            persyaratanRegistrasi += element.idPersyaratan + ',';
          }
          $('#persyaratan').html(persyaratan);
          $('#persyaratanRegistrasi').val(persyaratanRegistrasi);
        })
      }
    });



  })

  $(document).on('click', '.btn-hapus', function () {
    var id = $(this).attr('data-bs-id');
    $('.btn-hapus-modal').prop('href', '/minat/' + id + '/delete');
  })

});