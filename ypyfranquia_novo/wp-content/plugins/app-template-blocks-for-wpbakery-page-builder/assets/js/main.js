(function ($) {
	"use strict";
    jQuery(document).ready(function($){
        /*------------------------------
            counter section activation
        -------------------------------*/
        var counternumber = $('.count-num');
        counternumber.counterUp({
            delay: 20,
            time: 3000
        });
        /*--------------------
            wow js init
        --------------------*/
        new WOW().init();

        /*----------------------------------
            magnific popup activation
        ----------------------------------*/
        $('.image-popup').magnificPopup({
            type: 'image'
        });
        $('.video-play-btn').magnificPopup({
            type: 'video'
        });
        
        
       
        /*----------------------------------------
            screenshort carousel
        ----------------------------------------*/
        var $screenshortCarousel = $('.screenshort-carousel');
        if ($screenshortCarousel.length > 0) {
            $screenshortCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: false,
                nav: true,
                smartSpeed:3000,
                navText:['',''],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    767: {
                        items: 2,
                        nav: false
                    },
                    768: {
                        items: 2,
                        nav: false
                    },
                    960: {
                        items: 3,
                        nav:false
                    },
                    1200: {
                        items: 4
                    },
                    1920: {
                        items: 4
                    }
                }
            });
        }
        /*----------------------------------------
            testimonial carousel
        ----------------------------------------*/
        var $testimonialCarousel = $('.testimonial-carousel');
        if ($testimonialCarousel.length > 0) {
            $testimonialCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                smartSpeed:3000,
                animateIn:'fadeIn',
                animateOut:"fadeOut",
                navText:['',''],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    767: {
                        items: 1,
                        nav: false
                    },
                    768: {
                        items: 1,
                        nav: false
                    },
                    960: {
                        items: 1,
                        nav:false
                    },
                    1200: {
                        items: 1
                    },
                    1920: {
                        items: 1
                    }
                }
            });
        }
        /*----------------------------------------
            Team carousel
        ----------------------------------------*/
        var $teamCarousel = $('.team-carousel');
        if ($teamCarousel.length > 0) {
            $teamCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: true,
                nav: true,
                smartSpeed:3000,
                animateIn:'fadeIn',
                animateOut:"fadeOut",
                navText:['',''],
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    414: {
                        items: 1,
                        nav: false
                    },
                    767: {
                        items: 2,
                        nav: false
                    },
                    768: {
                        items: 2,
                        nav: false
                    },
                    960: {
                        items: 3,
                        nav:false
                    },
                    1200: {
                        items: 4
                    },
                    1920: {
                        items: 4
                    }
                }
            });
        }
        
     
    });

           
    $(window).on('load',function(){

    });

}(jQuery));	
