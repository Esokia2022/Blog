jQuery.noConflict();
(function ($) {
    var _width = $(window).width();
    var _height = $(window).height();
    $(function () {

        $('.menu-left-wrapper a').on('click', function(){
            if(!$('body').hasClass('homepage')){
                $('.menu-left-wrapper a').removeClass('active');
                $('body').removeClass('orange vert bleu');
                $(this).addClass('active');
                if($(this).hasClass('agriculture')){
                    $('body').addClass('orange');
                }else if($(this).hasClass('elevage')){
                    $('body').addClass('bleu');
                }else if($(this).hasClass('parc-jardin')){
                    $('body').addClass('vert');
                }
            }
        });

        $('.btn-burger-mobile').on('click', function(e){
            e.preventDefault();
            $('.navigation-mobile').toggleClass('menu-show');
            if($('.navigation-mobile').hasClass('menu-show')){
                $('.header-top-mobile').css({'visibility':'hidden'});
                $('html').addClass('pos-fixed');
            }else{
                $('.header-top-mobile').css({'visibility':'visible'});
                $('html').removeClass('pos-fixed');
            }
        });

        $('.btn-close').on('click', function(e){
            e.preventDefault();
            $('.btn-burger-mobile').trigger('click');
        })

        $('.menu-mobile > li > a').on('click', function(e){
            e.preventDefault();
            $('.sub-menu > li').removeClass('droopdown');
            $('.sub-sub-menu').hide();
            $(this).siblings('.sub-menu').toggle();
        });

        $('.sub-menu > li > a').on('click', function(e){
            e.preventDefault();
            $('.sub-menu > li').removeClass('droopdown');
            $('.sub-sub-menu').hide();
            $(this).parent('li').addClass('droopdown');
            $(this).siblings('.sub-sub-menu').toggle();
        });

        /*metier mobile*/
        $('.top-left-menu > a').on('click', function(){
            $(this).siblings('ul').toggle();
        })

        $('.top-left-menu ul li').on('click', function(){
            var _text   = $(this).children('a').text(),
                _anchor = $('.top-left-menu > a');
            $('body').removeClass('orange vert bleu');

            if($(this).hasClass('metier-agri')){
                var _background = $('.top-left-menu ul li.metier-agri').css('background');
                _anchor.text(_text).css({'background': _background});
                $('body').addClass('orange');
            }else if($(this).hasClass('metier-elevage')){
                var _background = $('.top-left-menu ul li.metier-elevage').css('background');
                _anchor.text(_text).css({'background': _background});
                $('body').addClass('bleu');
            }else if($(this).hasClass('metier-parc')){
                var _background = $('.top-left-menu ul li.metier-parc').css('background');
                _anchor.text(_text).css({'background': _background});     
                $('body').addClass('vert'); 
            }
            $('.top-left-menu ul').toggle();
        })
        /*-- metier mobile*/

        if(_width < 768){
            $('#processEcommerce01, #processEcommerce02, #processEcommerce05, #confirmation, #annonceur').on('shown.bs.modal', function() {
                $('html').addClass('pos-fixed');
            });
     
            $('#processEcommerce01, #processEcommerce02, #processEcommerce05, #confirmation, #annonceur').on('hidden.bs.modal', function() {
                $('html').removeClass('pos-fixed');
            });
        }



        if(_width < 992){
            $('.nos-metiers-wrapper').slick({
                centerMode:true,
                dots : true,
                arrows : false,
                slidesToShow: 1,
                slidesToScroll:1,
                variableWidth: true,
                autoplay:true
            });
        }

        /*slide fiche produit*/
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav',
            autoplay: true
        });
        $('.slider-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            //centerMode: true,
            focusOnSelect: true,
            arrows:false,
            variableWidth: true
        });

        plyr.setup();
        /*--slide fiche produit*/

        /*product tabs*/
        $('#complementaire-slick').slick({
            //centerMode:true,
            dots: false,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            speed: 0,
            adaptiveHeight:false,
            responsive: [
                {
                    breakpoint: 1600,
                    settings: {
                        slidesToScroll: 3,
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToScroll: 2,
                        slidesToShow: 2,
                        autoplay: false
                    }
                }
            ]
        });
        $('#similaire-slick').slick({
            //centerMode:true,
            dots: false,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            speed: 0,
            adaptiveHeight:false,
            responsive: [
                {
                    breakpoint: 1600,
                    settings: {
                        slidesToScroll: 3,
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToScroll: 2,
                        slidesToShow: 2,
                    }
                }
            ]
        });
        /*product tabs*/



        var $productTabsMenu = $('.product-tabs-menu ul li a');
        $productTabsMenu.on('click', function(e){
            e.preventDefault();
            $('#complementaire-slick').slick('refresh');
            $('#similaire-slick').slick('refresh');
            var id = $(this).attr('href');
            //alert(id);
            $productTabsMenu.removeClass('active');
            $(this).addClass('active');
            $('.product-tabs').hide();
            $(id).show();
        });


        $productTabsMenu.on('click', function(e){
            if($(this).hasClass('menu-product')){
                $('.product-tabs-menu-wrapper').addClass('menu-bg');
            }else{
                $('.product-tabs-menu-wrapper').removeClass('menu-bg');
            }
        });
        /*--tabs produit*/

        /*list annonce*/
        $('.input-categorie').on('click', function(){
            $('.categorie-option').toggle();
        })

        $('.categorie-option a').on('click', function(e){
            e.preventDefault();
            var _value = $(this).text();
            $('.input-categorie').val(_value);
            $('.categorie-option').toggle();
        });


        /*list annonce*/




        // if(_width < 768){
        //     $('.promos-list').slick({
        //         centerMode:true,
        //         dots : false,
        //         arrows : false,
        //         slidesToShow: 1,
        //         slidesToScroll:1,
        //         variableWidth: true,
        //         //autoplay:true
        //     });
        // }


        //code jquery ready
        //if(_width > 767){
            $('.partenaire-list').slick({
                slidesToShow: 9,
                slidesToScroll: 9,
                autoplay: true,
                dots: false,
                arrows: false,
                variableWidth: true
            });
        //}

        $('.metier-baniere').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            vertical: true,
            dots: true,
            arrows:false,
            responsive : [
                {
                    breakpoint:767,
                    settings:{
                        vertical:false
                    }
                }
            ]
        });

        $(window).on('scroll', function () {
            if ($(window).scrollTop() > 0) {
                $('header').addClass('fixed');
                $('.baniere, .metier-baniere, .nos-metiers, .product-about').addClass('baniere-with-margin');
            } else {
                $('header').removeClass('fixed');
                $('.baniere, .metier-baniere, .nos-metiers, .product-about').removeClass('baniere-with-margin');
            }
        });

        $('select').selectpicker();

        /*table responsive detail product*/
        $('.table-desktop').basictable({
            breakpoint: 991
        });

        /*custom input number*/
        $('<div class="quantity-nav"><div class="quantity-button quantity-up"><span class="qty-up-btn"></span></div><div class="quantity-button quantity-down"><span class="qty-down-btn"></span></div></div>').insertAfter('.quantity input');
        $('.quantity').each(function () {
            var spinner = $(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');


            btnUp.click(function () {
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

            btnDown.click(function () {
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

        });


        $('.delete').on('click', function (e) {
            e.preventDefault();
            $(this).parents('tr').remove();
        });

        /*panier livraison*/
        $('.livraison-choix input').on('click', function(){
            $('.process-ecommerce-2-wrapper tr').removeClass('choix-checked');
            if($(this).is(':checked')){
                $(this).parents('tr').addClass('choix-checked');
            }
        });

        $('.livraison-item').on('click', function(){
            //alert('test');
            $('.livraison-item').removeClass('choix-checked');
            var $input = $(this).find('input');
            
            if($input.not(':checked')){
                $input.prop('checked',true);
                $(this).addClass('choix-checked');
            }
        })
        /*!panier livraison*/

        /*popup panier*/
        $('.btn-popup').trigger('click');

        /*selection magasin*/
        $('.btn-choix').on('click', function (e) {
            e.preventDefault();
            $(this).hide();
            $(this).siblings('.btn-selectionner').css({'display': 'inline-block'});
            $(this).parents('.store-position-item').addClass('store-position-item-selectionner');
        });

        $('.btn-selectionner').on('click', function (e) {
            e.preventDefault();
            $(this).hide();
            $(this).siblings('.btn-choix').css({'display': 'inline-block'});
            $(this).parents('.store-position-item').removeClass('store-position-item-selectionner');
        });
        /*--selection magasin*/


        /*fiche produit*/
        /*zoom*/
        /*$("#img_01").elevateZoom({gallery:'gal1', 
        cursor: 'pointer',
        responsive:true,
        galleryActiveClass: 'active', 
        imageCrossfade: true, 
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});*/ 

        //pass the images to Fancybox
        /*$("#img_01").bind("click", function(e) {  
            var ez =   $('#img_01').data('elevateZoom');	
            $.fancybox(ez.getGalleryList());
            return false;
        });*/
        /*zoom*/
        /*--fiche produit*/

        /*categorie filter fixe*/
        var asideTop = $('.aside-filter').offset().top - 300;
        /*- parseFloat($('.aside-filter').css('marginTop').replace(/auto/, 0));*/
        var blogHeight = $('.categorie-list').outerHeight() - 350;
        var blocToAddPadding = $('.categorie-list').outerHeight();
        $(window).scroll(function () {
            if ($(window).width() > 992) {
                var asideY = $(this).scrollTop();
                var windowScrollTop = $(this).scrollTop();
                if (asideY > asideTop) {
                    $('.aside-filter').css({
                        position: 'fixed',
                        top: '210px',
                    });
                    $('.aside-filter').addClass('filter-fixed');
                    $('.categorie-list').addClass('offset-xl-3 offset-lg-3 offset-md-3');
                } else {
                    $('.aside-filter').removeAttr('style');
                    $('.aside-filter').removeClass('filter-fixed');
                    $('.categorie-list').removeClass('offset-xl-3 offset-lg-3 offset-md-3');
                }

                if (windowScrollTop >= blogHeight) {
                    //$('.aside-filter').addClass('filter-fixed-withpadding');
                    $('.prefooter, footer').addClass('add-zindex');
                } else {
                    //$('.aside-filter').removeClass('filter-fixed-withpadding');
                    $('.prefooter, footer').removeClass('add-zindex');
                }

                if (windowScrollTop >= blocToAddPadding) {
                    $('.aside-filter').addClass('filter-fixed-withpadding');
                } else {
                    $('.aside-filter').removeClass('filter-fixed-withpadding');
                }

            }

        });

        /*categorie filtre option*/
        $('.btn-option').on('click', function (e) {
            e.preventDefault();
            $('.categorie-list').toggleClass('col-sm-12').toggleClass('col-sm-8');
            $('.aside').toggle();
        });

        /*Categorie filtre*/
        $('.filterNumber ul li a').click(function (e) {
            e.preventDefault();
            $that = $(this);
            $that.parent().find('.filterNumber ul li a').removeClass('active');
            $that.addClass('active');
        });

        $('.filterNumber ul li a').click(function (e) {
            e.preventDefault();
            $that = $(this);

            $('.filterNumber ul li').find('a').removeClass('active');
            $that.addClass('active');
        });

        /**
         * Fonction slide filtre aside
         */

        $("#height-range").slider({
            range: true,
            min: 100,
            max: 150,
            values: [110, 135],
            slide: function (event, ui) {
                $("#minheight").val(ui.values[0] + " €");
                $("#maxheight").val(ui.values[1] + " €");
            }
        });
        $("#minheight").val($("#height-range").slider("values", 0) + " €");
        $("#maxheight").val($("#height-range").slider("values", 1) + " €");
        /*etat menu active*/


    });

    $(window).on('load resize orientationchange', function () {
        if($(window).width() < 992){
            $('.nos-metiers-wrapper').slick({
                centerMode:true,
                dots : true,
                arrows : false,
                slidesToShow: 1,
                slidesToScroll:1,
                variableWidth: true,
                autoplay:true
            });
        }else{
            //alert('sup');
            $('.nos-metiers-wrapper').slick('unslick');
        }

        if($(window).width() < 768){
            $('.promos-list, .nouveaute-list').not('.slick-initialized').slick({
                centerMode:true,
                dots : false,
                arrows : false,
                slidesToShow: 1,
                slidesToScroll:1,
                variableWidth: true,
                //autoplay:true
            });
        }else{
            $('.promos-list, .nouveaute-list').not('.slick-initialized').slick('unslick');
        }

        /*if($(window).width() > 767){
            $('.partenaire-list').slick({
                slidesToShow: 9,
                slidesToScroll: 9,
                autoplay: true,
                dots: false,
                arrows: false,
                variableWidth: true
            });
        }else{
            $('.partenaire-list').slick('unslick');
        }*/

        // $('.menu-left-wrapper a').removeClass('active');
        // if ($('body').hasClass('orange')) {
        //     $('.menu-left-wrapper a.agriculture').addClass('active');
        // }
        // if ($('body').hasClass('bleu')) {
        //     $('.menu-left-wrapper a.elevage').addClass('active');
        // }
        // if ($('body').hasClass('vert')) {
        //     $('.menu-left-wrapper a.parc-jardin').addClass('active');
        // }
        /*Nos magasing*/
        $(".store-position-listing-wrapper").mCustomScrollbar();
    });
})(jQuery);









