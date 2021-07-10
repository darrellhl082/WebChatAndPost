$(document).ready(function () {

    $('.changeBtn').on('click', function () {
        $('.change').toggleClass('d-none');
        $('.changeBtn').toggleClass('active');
        if ($('.changeBtn').hasClass('active')) {
            $('.changeBtn').html('Cancel Update Photo ');
        } else {
            $('.changeBtn').html('Change My Photo Profile');
        }

    })


});