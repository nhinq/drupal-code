(function ($) {
Drupal.behaviors.global = {
    attach: function (context, settings) {  
    /*---------Begin js------------*/
    
    //$(".product-title-bar").click(function(){
        //$(this).children(".fa").removeClass("fa-angle-double-right");
        //$(".product-title-bar i").removeClass("fa-angle-double-right");
        //$(".product-content-info").slideToggle();
        /*if($(".product-title-bar").attr('class').split(' ')[1]== "fa-angle-double-right") {
            $(".product-title-bar").removeClass("fa-angle-double-right");
            $(".product-title-bar").addClass("fa-angle-double-down");
        }else{
            $(".product-title-bar").removeClass("fa-angle-double-down");
            $(".product-title-bar").addClass("fa-angle-double-right");
        }*/
    //});
    
    var wrap = $('#wrap').width(); 
   var real_img = $('#wrap a img').width();
   var mgr = (wrap-real_img)/2;
   $('#wrap').css({'margin-right': '-'+mgr+'px'});
   
   $('.btn.checkout-continue').addClass('btn-danger');
   
   $('.link-list li.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });
    
    $('.search-product div.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });
    
    $(".search-product .filter-by div.dropdown").hover(
      function () {
        $(this).find('.dropdown-hover').addClass("button-hover");
      },
      function () {
        $(this).find('.dropdown-hover').removeClass("button-hover");
      }
    );
     $(".search-product div.dropdown .content-wrap .item-list").append('<div class="content-ugly-truth"></div>');
    $('.search-products .form-type-select select option:first-child').text('- All Categories -');
    $('.nav-mobileheader form .form-type-select select option:first-child').text('- All Categories -');
     //$( ".field-group-accordion-wrapper" ).accordion();
     $('h3.field-group-accordion-active').attr({'aria-selected':'true','aria-hidden':'false'}).slideDown();
     $('.product-description-accordion-item ').attr({'aria-expanded':'true','aria-hidden':'false'}).slideDown();
     
     ////////////////////////////////////
     
    
    $('#dropdown').hover(function() {
      $(this).find('.dropdown-category').stop(true, true).delay(200).fadeIn();
    }, function() {
      $(this).find('.dropdown-category').stop(true, true).delay(200).fadeOut();
    }); 
    
    
    $('.home-slider .flexslider').flexslider({
        animation: "slide"
    });
      
    $('.best-buy .flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 210,
        itemMargin: 10
    });  
    /*
    $(".cloud-zoom-gallery-thumbs").jcarousel({
            minSlides : 6,
            maxSlides : 6,
            slideWidth : 120,
            slideMargin : 20,
            moveSlides : 1,
            pager : false,
            speed : 700,
            infiniteLoop : false,
            hideControlOnEnd : true,
            nextText : '<i class="fa fa-angle-right"></i>',
            prevText : '<i class="fa fa-angle-left"></i>',
            onSlideBefore : function($slideElement, oldIndex, newIndex){
            }
    });**/
    /*---------End js------------*/
    }
  };
})(jQuery);