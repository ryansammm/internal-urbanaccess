$(function() {
    // https://github.com/uxsolutions/bootstrap-datepicker
$('.dateselect').datepicker({
    format: 'mm/dd/yyyy',
    // startDate: '-3d'
});

$('.dateselect2').datepicker({
    format: 'mm/dd/yyyy',
    // startDate: '-3d'
});


var isShown = false;
 $("#sudahwafat").click(function() {
    isShown = !isShown ? true : false;
    $('#statusWafat').val(isShown ? '2' : '1');

    $("#tanggalwafat").toggleClass("invisible");
    // if (isShown) {
    //     $("#tanggalwafat").find('.tanggalwafatNarsum').prop('disabled', true);
    // } else {
    //     $("#tanggalwafat").find('.tanggalwafatNarsum').prop('disabled', false);
    // }

    $("#longitudewafat").toggleClass("invisible");
    // if (isShown) {
    //     $("#longitudewafat").find('.longtitude').prop('disabled', true);
    // } else {
    //     $("#longitudewafat").find('.longtitude').prop('disabled', false);
    // }

    $("#latitudewafat").toggleClass("invisible");
    // if (isShown) {
    //     $("#latitudewafat").find('.latitude').prop('disabled', true);
    // } else {
    //     $("#latitudewafat").find('.latitude').prop('disabled', false);
    // }
});

// $('.dateselect2').datepicker({
//     format: 'mm/dd/yyyy',
//     autoclose:true,
//     todayHighlidht: true,
// }).on("hide", function(){
//   if ($)
// }
});





 