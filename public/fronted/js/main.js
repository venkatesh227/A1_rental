; (function ($) {
    "use strict";

    $(document).ready(function () {

        /**-----------------------------
         *  Navbar fix
         * ---------------------------*/
        $(document).on('click', '.navbar-area .navbar-nav li.menu-item-has-children>a', function (e) {
            e.preventDefault();
        })

        $(document).on('mouseover','.single-intro-inner',function() {
            $(this).addClass('single-intro-inner-active');
            $('.single-intro-inner').removeClass('single-intro-inner-active');
            $(this).addClass('single-intro-inner-active');
        });
       
        /*-------------------------------------
            menu
        -------------------------------------*/
        $('.navbar-area .menu').on('click', function() {
            $(this).toggleClass('open');
            $('.navbar-area .navbar-collapse').toggleClass('sopen');
        });
    
        // navbar-click
        $(".menu-item-has-children a").on("click", function () {
            var element = $(this).parent("li");
            if (element.hasClass("show")) {
                element.removeClass("show");
                element.children("ul").slideUp(500);
            }
            else {
                element.siblings("li").removeClass('show');
                element.addClass("show");
                element.siblings("li").find("ul").slideUp(500);
                element.children('ul').slideDown(500);
            }
        });

        window.addEventListener('resize', function () {
            if (screen.width > 991) {
                $('.sub-menu').show();
            }else{
                $('.sub-menu').hide();
            }
        }, true);

        /*--------------------------------------------------
            select onput
        ---------------------------------------------------*/
        if ($('.single-select').length){
            $('.single-select').niceSelect();
        }

        /* --------------------------------------------------
            isotop filter 
        ---------------------------------------------------- */
        var $Container = $('.isotop-filter-area');
        if ($Container.length > 0) {
            $('.property-filter-area').imagesLoaded(function () {
                var festivarMasonry = $Container.isotope({
                    itemSelector: '.project-filter-item', // use a separate class for itemSelector, other than .col-
                    masonry: {
                        gutter: 0
                    }
                });
                $(document).on('click', '.isotop-filter-menu > button', function () {
                    var filterValue = $(this).attr('data-filter');
                    festivarMasonry.isotope({
                        filter: filterValue
                    });
                });
            });
            $(document).on('click','.isotop-filter-menu > button' , function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            });
        }

        /*--------------------------------------------
            Search Popup
        ---------------------------------------------*/
        var bodyOvrelay =  $('#body-overlay');
        var searchPopup = $('#td-search-popup');
        var sidebarMenu = $('#sidebar-menu');

        $(document).on('click','#body-overlay',function(e){
            e.preventDefault();
            bodyOvrelay.removeClass('active');
            searchPopup.removeClass('active');
            sidebarMenu.removeClass('active');
        });
        $(document).on('click','.search-bar-btn',function(e){
            e.preventDefault();
            searchPopup.addClass('active');
        bodyOvrelay.addClass('active');
        });

        // sidebar menu 
        $(document).on('click', '.sidebar-menu-close', function (e) {
            e.preventDefault();
            bodyOvrelay.removeClass('active');
            sidebarMenu.removeClass('active');
        });
        $(document).on('click', '#navigation-button', function (e) {
            e.preventDefault();
            sidebarMenu.addClass('active');
            bodyOvrelay.addClass('active');
        });

        /* -----------------------------------------------------
            Variables
        ----------------------------------------------------- */
        var leftArrow = '<i class="fa fa-angle-left"></i>';
        var rightArrow = '<i class="fa fa-angle-right"></i>';

        /*------------------------------------------------
            intro-slider
        ------------------------------------------------*/
        $('.intro-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: false,
            smartSpeed: 1500,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                992: {
                    items: 4
                },
            }
        });

        /*------------------------------------------------
            banner-slider
        ------------------------------------------------*/ 

        $('.banner-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: false,
            animateOut: 'fadeOut',
            smartSpeed: 1500,
            items: 1, 
            autoplay: true,
            URLhashListener:true,
            startPosition: 'URLHash'
        });

        $('.banner-slider').on('changed.owl.carousel', function(event) {
            var current = event.item.index;
            var hash = $(event.target).find(".owl-item").eq(current).find(".item").attr('data-hash');
            $('.'+hash).addClass('active');
          });
      
          $('.banner-slider').on('change.owl.carousel', function(event) {
            var current = event.item.index;
            var hash = $(event.target).find(".owl-item").eq(current).find(".item").attr('data-hash');
            $('.'+hash).removeClass('active');
          }); 


          /*------------------------------------------------
            banner-slider
        ------------------------------------------------*/ 

        $('.banner-slider-2').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            navText: ["<span>↽</span>","<span>⇀</span>"],
            animateOut: 'fadeOut',
            smartSpeed: 1500,
            items: 1, 
            autoplay: true,
            URLhashListener:true,
            startPosition: 'URLHash'
        });
        /*------------------------------------------------
            category-slider
        ------------------------------------------------*/
        $('.category-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            smartSpeed: 1500,
            items: 5,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                768: {
                    items: 4
                },
            }
        });

        /*------------------------------------------------
            testimonial-slider
        ------------------------------------------------*/
        $('.testimonial-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            smartSpeed: 1500,
            navText: ["<span>↽</span>","<span>⇀</span>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                768: {
                    items: 2
                },
            }
        });

        /*------------------------------------------------
            gallery-slider
        ------------------------------------------------*/
        $('.gallery-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            smartSpeed: 1500,
            navText: ["<span>↽</span>","<span>⇀</span>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                991: {
                    items: 3
                },
            }
        });

        /*------------------------------------------------
            client-slider
        ------------------------------------------------*/
        $('.client-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: false,
            smartSpeed: 1500,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                992: {
                    items: 5
                },
            }
        });

        /*------------------------------------------------
            instagram-slider
        ------------------------------------------------*/
        $('.instagram-slider').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: false,
            smartSpeed: 1500,
            autoplay: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                992: {
                    items: 6
                },
            }
        });

        $('.team-slider').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: false,
            smartSpeed: 1500,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                992: {
                    items: 1
                },
            }
        });

        // Cart Item Slide 

        $(document).on('click', '.dot-01', function(e) {
            e.preventDefault();
            $(this).parent().parent().find('.image-item-02').addClass('item-active');
            $(this).parent().parent().find('.dot-01').addClass('active');
            $(this).parent().parent().find('.dot-02').removeClass('active');
        });
        $(document).on('click', '.dot-02', function(e) {
            e.preventDefault();
            $(this).parent().parent().find('.image-item-02').removeClass('item-active');
            $(this).parent().parent().find('.dot-01').removeClass('active');
            $(this).parent().parent().find('.dot-02').addClass('active');
        });

        /*------------------------------------------------
            Magnific JS
        ------------------------------------------------*/
        $('.video-play-btn').magnificPopup({
            type: 'iframe',
            removalDelay: 260,
            mainClass: 'mfp-zoom-in',
        });
        $.extend(true, $.magnificPopup.defaults, {
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/Wimkqo8gDZ0'
                    }
                }
            }
        });

        /* magnificPopup img view */
        $(".popup-image").magnificPopup({
            type: "image",
            mainClass: 'mfp-zoom-in', 
            removalDelay: 260,
            gallery: {
                enabled: true,
            },
        });


        $('.without-caption').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 300 // don't foget to change the duration also in CSS
            }
        });
    
        $('.with-caption').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function(item) {
                    return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
                }
            },
            zoom: {
                enabled: true
            }
        });

        var productDetailSlider2 = $('.single-thumbnail-slider-2');
        var pThumbanilSlider2 = $('.product-thumbnail-carousel-2');

        if (productDetailSlider2.length) {
            productDetailSlider2.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                speed: 2500,
                asNavFor: '.product-thumbnail-carousel-2'
            });
        }
        if (pThumbanilSlider2.length) {
            pThumbanilSlider2.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.single-thumbnail-slider-2',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                arrows:true,
                prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left"></i></div>',
                nextArrow: '<div class="slick-next"><i class="fa fa-angle-right"></i></div>',
            });
        }

        /*---------------------------------------
            Quantity
        ---------------------------------------*/
        function wcqib_refresh_quantity_increments() {
            jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
                var c = jQuery(b);
                c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
            })
        }
        String.prototype.getDecimals || (String.prototype.getDecimals = function() {
            var a = this,
                b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
        }), jQuery(document).ready(function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("updated_wc_div", function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("click", ".plus, .minus", function() {
            var a = jQuery(this).closest(".quantity").find(".qty"),
                b = parseFloat(a.val()),
                c = parseFloat(a.attr("max")),
                d = parseFloat(a.attr("min")),
                e = a.attr("step");
            b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
        });

        /* -----------------------------------------
            fact counter
        ----------------------------------------- */
        $('.counter').counterUp({
            delay: 15,
            time: 2000
        });


        /*----------------------------------------
           back to top
        ----------------------------------------*/
        $(document).on('click', '.back-to-top', function () {
            $("html,body").animate({
                scrollTop: 0
            }, 2000);
        });

    });

    $(window).on("scroll", function() {
        /*---------------------------------------
            back-to-top
        -----------------------------------------*/
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }

        /*---------------------------------------
            sticky-active
        -----------------------------------------*/
        var scroll = $(window).scrollTop();
        if (scroll < 445) {
            $(".navbar").removeClass("sticky-active");
        } else {
            $(".navbar").addClass("sticky-active");
        }

    });


    $(window).on('load', function () {

        /*-----------------
            preloader
        ------------------*/
        var preLoder = $("#preloader");
        preLoder.fadeOut(0);

        /*-----------------
            back to top
        ------------------*/
        var backtoTop = $('.back-to-top')
        backtoTop.fadeOut();

        /*---------------------
            Cancel Preloader
        ----------------------*/
        $(document).on('click', '.cancel-preloader a', function (e) {
            e.preventDefault();
            $("#preloader").fadeOut(2000);
        });

    });



})(jQuery);