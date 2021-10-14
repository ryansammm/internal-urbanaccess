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

  var inputBank = "";
  $(document).on('click', '.tambahBank', function() {
    inputBank += '<tr><td><input type="text" name="" id="" class="form-control"></td><td><input type="text" name="" id="" class="form-control"></td><td><a href="#" style="color: #7d7a7a;font-size: 30pt;"><i class="bi bi-plus"></i></a><a href="#" style="tambahBank" style="color: #7d7a7a;font-size: 30pt;"><i class="bi bi-dash"></i></a></td></tr>';
  })