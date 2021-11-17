// SUNTING DATA LINGKUNGAN KELUARGA
var modalsuntingtekel = document.getElementById('modalsuntingtekel')
modalsuntingtekel.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var jenisAnggotakeluarga = button.getAttribute('data-bs-jenis_anggota_keluarga')
    var namaAnggotakeluarga = button.getAttribute('data-bs-nama_anggota_keluarga')
    var jeniskelaminAnggotakeluarga = button.getAttribute('data-bs-jk_anggota_keluarga')
    var tempatlahirAnggotakeluarga = button.getAttribute('data-bs-tempat_lahir_anggota')
    var tanggallahirAnggotakeluarga = button.getAttribute('data-bs-tanggal_lahir_anggota')
    var idLingkugankeluarga = button.getAttribute('data-bs-id_lingkungan_keluarga')
    
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modaljenisAnggotakeluarga = modalsuntingtekel.querySelector('.modal-body input.jenisAnggotakeluarga')
    var modalnamaAnggotakeluaraga = modalsuntingtekel.querySelector('.modal-body input.namaAnggotakeluaraga')
    var modaljeniskelaminAnggotakeluarga = modalsuntingtekel.querySelector('.modal-body input.jeniskelaminAnggotakeluarga')
    var modaltempatlahirAnggotakeluarga = modalsuntingtekel.querySelector('.modal-body input.tempatlahirAnggotakeluarga')
    var modaltanggallahirAnggotakeluarga = modalsuntingtekel.querySelector('.modal-body input.tanggallahirAnggotakeluarga')
    var formSubmitSunting = modalsuntingtekel.querySelector('.modal-body form.form')
    
    modaljenisAnggotakeluarga.value = jenisAnggotakeluarga
    modalnamaAnggotakeluaraga.value = namaAnggotakeluarga
    modaltempatlahirAnggotakeluarga.value = tempatlahirAnggotakeluarga
    modaltanggallahirAnggotakeluarga.value = tanggallahirAnggotakeluarga
    //modaljeniskelaminAnggotakeluarga.value = jeniskelaminAnggotakeluarga //== "L" ? modalsuntingtekel.querySelector('.modal-body input#inlineRadio1').setAttribute('checked', true) : modalsuntingtekel.querySelector('.modal-body input#inlineRadio2').setAttribute('checked', true)
    
    var urlAction = '/lingkungan-keluarga/' + idLingkugankeluarga + '/update'
    
    console.log(idLingkugankeluarga)
    
    formSubmitSunting.setAttribute('action', urlAction)
    console.log(jenisAnggotakeluarga, namaAnggotakeluarga, jeniskelaminAnggotakeluarga, tempatlahirAnggotakeluarga, tanggallahirAnggotakeluarga, idLingkugankeluarga);
    
})

// SUNTING DATA RIWAYAT PENDIDIKAN FORMAL
var modalsuntingformal = document.getElementById('modalsuntingformal')
modalsuntingformal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var namaSekolah = button.getAttribute('data-bs-nama_sekolah')
    var jurusanSekolah = button.getAttribute('data-bs-jurusan_sekolah')
    var tempatSekolah = button.getAttribute('data-bs-tempat_sekolah')
    var tahunmasukSekolah = button.getAttribute('data-bs-tahun_masuk_sekolah')
    var tahunkeluarSekolah = button.getAttribute('data-bs-tahun_keluar_sekolah')
    var keteranganRiwayatpendidikanformal = button.getAttribute('data-bs-keterangan_riwayat_formal')

    var idRiwayatpendidikanformal = button.getAttribute('data-bs-id_riwayat_formal')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalnamaSekolah = modalsuntingformal.querySelector('.modal-body input.namaSekolah')
    var modaljurusanSekolah = modalsuntingformal.querySelector('.modal-body input.jurusanSekolah')
    var modaltempatSekolah = modalsuntingformal.querySelector('.modal-body input.tempatSekolah')
    var modaltahunmasukSekolah = modalsuntingformal.querySelector('.modal-body input.tahunmasukSekolah')
    var modaltahunkeluarSekolah = modalsuntingformal.querySelector('.modal-body input.tahunkeluarSekolah')
    var modalketeranganRiwayatpendidikanformal = modalsuntingformal.querySelector('.modal-body textarea.keteranganRiwayatpendidikanformal')

    var formActionFormal = modalsuntingformal.querySelector('.modal-body form.form')
    console.log(keteranganRiwayatpendidikanformal)

    modalnamaSekolah.value = namaSekolah
    modaljurusanSekolah.value = jurusanSekolah
    modaltempatSekolah.value = tempatSekolah
    modaltahunmasukSekolah.value = tahunmasukSekolah
    modaltahunkeluarSekolah.value = tahunkeluarSekolah
    modalketeranganRiwayatpendidikanformal.value = keteranganRiwayatpendidikanformal

    urlUpdate = '/riwayatPendidikanformal/' + idRiwayatpendidikanformal + '/update'

    formActionFormal.setAttribute('action', urlUpdate)

})

// SUNTING DATA RIWAYAT PENDIDIKAN INFORMAL
var modalsuntinginformal = document.getElementById('modalsuntinginformal')
modalsuntinginformal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var jenisKursus = button.getAttribute('data-bs-jenis_kursus')
    var tempatKursus = button.getAttribute('data-bs-tempat_kursus')
    var tahunKursus = button.getAttribute('data-bs-tahun_kursus')
    var keteranganRiwayatpendidikaninformal = button.getAttribute('data-bs-keterangan_riwayat_informal')

    var idRiwayatpendidikaninformal = button.getAttribute('data-bs-id_riwayat_informal')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modaljenisKursus = modalsuntinginformal.querySelector('.modal-body input.jenisKursus')
    var modaltempatKursus = modalsuntinginformal.querySelector('.modal-body input.tempatKursus')
    var modaltahunKursus = modalsuntinginformal.querySelector('.modal-body input.tahunKursus')
    var modalketeranganRiwayatpendidikaninformal = modalsuntinginformal.querySelector('.modal-body input.keteranganRiwayatpendidikaninformal')

    var formActionFormal = modalsuntinginformal.querySelector('.modal-body form.form')

    modaljenisKursus.value = jenisKursus
    modaltempatKursus.value = tempatKursus
    modaltahunKursus.value = tahunKursus
    modalketeranganRiwayatpendidikaninformal.value = keteranganRiwayatpendidikaninformal

    urlUpdate = '/riwayatPendidikaninformal/'+ idRiwayatpendidikaninformal +'/update'

    formActionFormal.setAttribute('action', urlUpdate)
})

// SUNTING DATA RIWAYAT PEKERJAAN
var modalsuntingPekerjaan = document.getElementById('modalsuntingPekerjaan')
modalsuntingPekerjaan.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var jabatanRiwayatPekerjaan = button.getAttribute('data-bs-jabatan_riwayat_pekerjaan')
    var bulanMasuk = button.getAttribute('data-bs-bulan_masuk')
    var bulanKeluar = button.getAttribute('data-bs-bulan_keluar')
    var tahunMasuk = button.getAttribute('data-bs-tahun_masuk')
    var tahunKeluar = button.getAttribute('data-bs-tahun_keluar')

    var idRiwayatpekerjaan = button.getAttribute('data-bs-id_riwayat_pekerjaan')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modaljenisRiwayatpekerjaan = modalsuntingPekerjaan.querySelector('.modal-body input.jabatanRiwayatpekerjaan')
    var modalbulanMasuk = modalsuntingPekerjaan.querySelector('.modal-body input.bulanMasuk')
    var modaltahunMasuk = modalsuntingPekerjaan.querySelector('.modal-body input.tahunMasuk')
    var modalbulanKeluar = modalsuntingPekerjaan.querySelector('.modal-body input.bulanKeluar')
    var modaltahunKeluar = modalsuntingPekerjaan.querySelector('.modal-body input.tahunKeluar')

    var formActionFormal = modalsuntingPekerjaan.querySelector('.modal-body form.form')

    modaljenisRiwayatpekerjaan.value = jabatanRiwayatPekerjaan
    modalbulanMasuk.value = bulanMasuk
    modaltahunMasuk.value = tahunMasuk
    modalbulanKeluar.value = bulanKeluar
    modaltahunKeluar.value = tahunKeluar

    urlUpdate = '/riwayatPekerjaan/'+ idRiwayatpekerjaan +'/update'

    formActionFormal.setAttribute('action', urlUpdate)

})