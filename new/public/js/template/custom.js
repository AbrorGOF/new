(function ($) {

  "use strict";

    // PRE LOADER
    // $(window).ready(function(){
      $('.preloader').fadeOut(1000); // set duration in brackets
    // });


    //Navigation Section
    $('[data-target="#navbar-collapse"]').on('click',function(){
      var checkClass = $("#navbar-collapse").hasClass('show');
      if (checkClass) {
        $("#navbar-collapse").collapse('hide')
      }else {
        $("#navbar-collapse").collapse('show')
      }
    });


    // Owl Carousel
    $('.owl-carousel').owlCarousel({
      animateOut: 'fadeOut',
      items:1,
      loop:true,
      autoplay:true,
    })


    // PARALLAX EFFECT
    // $.stellar();


    // SMOOTHSCROLL
    $(function() {
      $(' footer a').on('click', function(event) {
        var $anchor = $(this);
          $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 49
          }, 1000);
            event.preventDefault();
      });
    });


    // WOW ANIMATION
    // new WOW({ mobile: false }).init();

})(jQuery);
