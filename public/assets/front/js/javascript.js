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

/*End Header added class on scroll*/



/*faq icon + and - working*/

$(document).ready(function () {
    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function () {
      $(this)
        .prev(".card-header")
        .find(".fa")
        .addClass("fa-minus")
        .removeClass("fa-plus");
    });
  
    // Toggle plus minus icon on show hide of collapse element
    $(".collapse")
      .on("show.bs.collapse", function () {
        $(this)
          .prev(".card-header")
          .find(".fa")
          .removeClass("fa-plus")
          .addClass("fa-minus");
      })
      .on("hide.bs.collapse", function () {
        $(this)
          .prev(".card-header")
          .find(".fa")
          .removeClass("fa-minus")
          .addClass("fa-plus");
      });
  });
  /*End faq icon + and - working*/

  