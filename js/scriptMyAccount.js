$(document).ready(function () {
    $('.postField').on('click', function () {
        $('.postfield').removeClass('btn-outline-primary');
        $('.postField').addClass('btn-primary');
        $('.twitField').css('color', '#0B5ED7');
        $('.postField').css('color', 'white');
        $('.twitField').removeClass('btn-primary');
        $('.twitField').addClass('btn-outline-primary');
        $('.main').show();
        $('.right').hide();
    })
    $('.twitField').on('click', function () {
        $('.twitField').addClass('btn-primary');
        $('.twitfield').removeClass('btn-outline-primary');
        $('.twitField').css('color', 'white');
        $('.postField').css('color', '#0B5ED7');
        $('.postField').removeClass('btn-primary');
        $('.postField').addClass('btn-outline-primary');
        $('.right').show();
        $('.main').hide();
    })

    function myFunction(x) {
        if (x.matches) { // If media query matches
            $('.right').hide();
            $('.switch').show();
            $('.jumbotron').removeClass('w-25');
            $('.jumbotron').addClass('w-75');
            $('.jumbAvatar').removeClass('w-25');
            $('.jumbAvatar').addClass('w-50');
        }
    }

    var x = window.matchMedia("(max-width: 768px)")
    myFunction(x) // Call listener function at run time
    x.addListener(myFunction) // Attach listener function on state changes

    function myFunction2(y) {
        if (y.matches) { // If media query matches
            $('.right').show();
            $('.main').show();
            $('.switch').hide();
            $('.jumbotron').removeClass('w-75');
            $('.jumbotron').addClass('w-25');
            $('.jumbAvatar').removeClass('w-50');
            $('.jumbAvatar').addClass('w-25');
        }
    }

    var y = window.matchMedia("(min-width: 768px)")
    myFunction2(y) // Call listener function at run time
    y.addListener(myFunction2) // Attach listener function on state changes
})