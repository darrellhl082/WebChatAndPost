$(document).ready(function () {

    $('.postField').on('click', function () {
        $('.postfield').removeClass('btn-outline-primary')
        $('.postField').addClass('btn-primary')
        $('.twitField').removeClass('btn-primary')
        $('.twitField').addClass('btn-outline-primary')
        $('.main').removeClass('displayNone');
        $('.right').toggleClass('displayNone');
    })
    $('.twitField').on('click', function () {
        $('.twitField').addClass('btn-primary')
        $('.twitfield').removeClass('btn-outline-primary')
        $('.postField').removeClass('btn-primary')
        $('.postField').addClass('btn-outline-primary')
        $('.right').removeClass('displayNone');
        $('.main').toggleClass('displayNone');
    })

    function myFunction(x) {
        if (x.matches) { // If media query matches
            $('.right').addClass('displayNone');
        }
    }

    var x = window.matchMedia("(max-width: 768px)")
    myFunction(x) // Call listener function at run time
    x.addListener(myFunction) // Attach listener function on state changes

    function myFunction2(y) {
        if (y.matches) { // If media query matches
            $('.right').removeClass('displayNone');
            $('.main').removeClass('displayNone');
        }
    }

    var y = window.matchMedia("(min-width: 768px)")
    myFunction2(y) // Call listener function at run time
    y.addListener(myFunction2) // Attach listener function on state changes
    $('.refreshPost').on('click', function () {

        $.get('postAjax.php', function (data) {
            $('.postAjax').html(data);

        })
    });
    $('.refreshTweet').on('click', function () {

        $.get('tweetAjax.php', function (data) {
            $('.tweetAjax').html(data);

        })
    });
    // setInterval(ajaxCall, 1000); //300000 MS == 5 minutes

    // function ajaxCall() {
    //     $.get('postAjax.php', function (data) {
    //         $('.postAjax').html(data);

    //     })
    // }
})