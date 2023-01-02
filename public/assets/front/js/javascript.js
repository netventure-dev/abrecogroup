$('.testimonials').owlCarousel({
    loop:true,
    margin:50,
    nav:false,
    dots:true,
    autoplay: false,
	 responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:2
        }
    }
});

$('.projects').owlCarousel({
    loop:true,
    margin:20,
    nav:false,
    dots:true,
    autoplay: true,
	 responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

$('.slides').owlCarousel({
    loop:true,
    margin:0,
    nav:true,
    dots:true,
    autoplay: false,
	 responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

/*Header added class on scroll*/
$(window).scroll(function(){
    if ($(this).scrollTop() > 50) {
       $('.header_area').addClass('newClass');
    } else {
       $('.header_area').removeClass('newClass');
    }
});