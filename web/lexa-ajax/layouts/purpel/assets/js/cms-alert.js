
$(document).ready(function () {
    setTimeout(function () {
        $('.alert-success').fadeOut('slow');
    }, 3000); // 5000 milliseconds = 5 seconds



    setTimeout(function () {
        $('.alert alert-danger alert-solid mb-xl-0').fadeOut('slow');
    }, 3000); // 5000 milliseconds = 5 seconds



    setTimeout(function () {
        $('.alert alert-dark alert-solid mb-0').fadeOut('slow');
    }, 3000); // 5000 milliseconds = 5 seconds
});



// Toast ===========================================================================================

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}