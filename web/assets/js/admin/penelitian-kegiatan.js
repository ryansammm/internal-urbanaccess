$('.jenis_dokumen_laporan').on('change', function() {
    if ($(this).val() == '1') {
        $('.jenis_dokumen_laporan1').prop('disabled', false);
        $('.jenis_dokumen_laporan2').prop('disabled', true);
        $('.jenis_dokumen_laporan3').prop('disabled', true);
        $('.jenis_dokumen_laporan4').prop('disabled', true);
        $('.jenis_dokumen_laporan5').prop('disabled', true);
    } else if ($(this).val() == '2') {
        $('.jenis_dokumen_laporan1').prop('disabled', true);
        $('.jenis_dokumen_laporan2').prop('disabled', false);
        $('.jenis_dokumen_laporan3').prop('disabled', true);
        $('.jenis_dokumen_laporan4').prop('disabled', true);
        $('.jenis_dokumen_laporan5').prop('disabled', true);
    } else if ($(this).val() == '3') {
        $('.jenis_dokumen_laporan1').prop('disabled', true);
        $('.jenis_dokumen_laporan2').prop('disabled', true);
        $('.jenis_dokumen_laporan3').prop('disabled', false);
        $('.jenis_dokumen_laporan4').prop('disabled', true);
        $('.jenis_dokumen_laporan5').prop('disabled', true);
    } else if ($(this).val() == '4') {
        $('.jenis_dokumen_laporan1').prop('disabled', true);
        $('.jenis_dokumen_laporan2').prop('disabled', true);
        $('.jenis_dokumen_laporan3').prop('disabled', true);
        $('.jenis_dokumen_laporan4').prop('disabled', false);
        $('.jenis_dokumen_laporan5').prop('disabled', true);
    } else {
        $('.jenis_dokumen_laporan1').prop('disabled', true);
        $('.jenis_dokumen_laporan2').prop('disabled', true);
        $('.jenis_dokumen_laporan3').prop('disabled', true);
        $('.jenis_dokumen_laporan4').prop('disabled', true);
        $('.jenis_dokumen_laporan5').prop('disabled', false);
    }
})

$('.jenis_video_pelaporan').on('change', function() {
    if ($(this).val() == '1') {
        $('.jenis_video_pelaporan1').prop('disabled', false);
        $('.jenis_video_pelaporan2').prop('disabled', true);
        $('.jenis_video_pelaporan3').prop('disabled', true);
        $('.jenis_video_pelaporan4').prop('disabled', true);
    } else if ($(this).val() == '2') {
        $('.jenis_video_pelaporan1').prop('disabled', true);
        $('.jenis_video_pelaporan2').prop('disabled', false);
        $('.jenis_video_pelaporan3').prop('disabled', true);
        $('.jenis_video_pelaporan4').prop('disabled', true);
    } else if ($(this).val() == '3') {
        $('.jenis_video_pelaporan1').prop('disabled', true);
        $('.jenis_video_pelaporan2').prop('disabled', true);
        $('.jenis_video_pelaporan3').prop('disabled', false);
        $('.jenis_video_pelaporan4').prop('disabled', true);
    } else {
        $('.jenis_video_pelaporan1').prop('disabled', true);
        $('.jenis_video_pelaporan2').prop('disabled', true);
        $('.jenis_video_pelaporan3').prop('disabled', true);
        $('.jenis_video_pelaporan4').prop('disabled', false);
    }
})

$('.jenis_foto_pelaporan').on('change', function() {
    if ($(this).val() == '1') {
        $('.jenis_foto_pelaporan1').prop('disabled', false);
        $('.jenis_foto_pelaporan2').prop('disabled', true);
        $('.jenis_foto_pelaporan3').prop('disabled', true);
        $('.jenis_foto_pelaporan4').prop('disabled', true);
        $('.jenis_foto_pelaporan5').prop('disabled', true);
    } else if ($(this).val() == '2') {
        $('.jenis_foto_pelaporan1').prop('disabled', true);
        $('.jenis_foto_pelaporan2').prop('disabled', false);
        $('.jenis_foto_pelaporan3').prop('disabled', true);
        $('.jenis_foto_pelaporan4').prop('disabled', true);
        $('.jenis_foto_pelaporan5').prop('disabled', true);
    } else if ($(this).val() == '3') {
        $('.jenis_foto_pelaporan1').prop('disabled', true);
        $('.jenis_foto_pelaporan2').prop('disabled', true);
        $('.jenis_foto_pelaporan3').prop('disabled', false);
        $('.jenis_foto_pelaporan4').prop('disabled', true);
        $('.jenis_foto_pelaporan5').prop('disabled', true);
    } else if ($(this).val() == '4') {
        $('.jenis_foto_pelaporan1').prop('disabled', true);
        $('.jenis_foto_pelaporan2').prop('disabled', true);
        $('.jenis_foto_pelaporan3').prop('disabled', true);
        $('.jenis_foto_pelaporan4').prop('disabled', false);
        $('.jenis_foto_pelaporan5').prop('disabled', true);
    } else if ($(this).val() == '5') {
        $('.jenis_foto_pelaporan1').prop('disabled', true);
        $('.jenis_foto_pelaporan2').prop('disabled', true);
        $('.jenis_foto_pelaporan3').prop('disabled', true);
        $('.jenis_foto_pelaporan4').prop('disabled', true);
        $('.jenis_foto_pelaporan5').prop('disabled', false);
    }
})