import $ from 'jquery';

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll > 10) {
        $("#site-nav").addClass("fixedHeader");
    }
    else {
        $("#site-nav").removeClass("fixedHeader");
    }
});