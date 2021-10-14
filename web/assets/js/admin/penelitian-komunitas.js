$('.kepemilikanBangunan').on('change', function() {
    if ($(this).val() == '1') {
        $('.kepemilikanBangunan1').prop('disabled', false);
        $('.kepemilikanBangunan2').prop('disabled', true);
        $('.kepemilikanBangunan3').prop('disabled', true);
        $('.kepemilikanBangunan4').prop('disabled', true);
    } else if ($(this).val() == '2') {
        $('.kepemilikanBangunan1').prop('disabled', true);
        $('.kepemilikanBangunan2').prop('disabled', false);
        $('.kepemilikanBangunan3').prop('disabled', true);
        $('.kepemilikanBangunan4').prop('disabled', true);
    } else if ($(this).val() == '3') {
        $('.kepemilikanBangunan1').prop('disabled', true);
        $('.kepemilikanBangunan2').prop('disabled', true);
        $('.kepemilikanBangunan3').prop('disabled', false);
        $('.kepemilikanBangunan4').prop('disabled', true);
    } else {
        $('.kepemilikanBangunan1').prop('disabled', true);
        $('.kepemilikanBangunan2').prop('disabled', true);
        $('.kepemilikanBangunan3').prop('disabled', true);
        $('.kepemilikanBangunan4').prop('disabled', false);
    }
})