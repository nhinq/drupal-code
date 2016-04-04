(function ($) {
Drupal.behaviors.global = {
    attach: function (context) {
    
    $('#block-views-what-s-new-block-1').prepend('<fieldset></fieldset>');
    $('#block-taxonomy-menu-block-1').prepend('<fieldset></fieldset>');
    $('#block-views-exp-list-directory-page').prepend('<fieldset></fieldset>');
    //$('#block-views-exp-list-directory-page .views-exposed-widgets').prepend('<span class="setting"></span >');
    //$('#block-views-exp-list-directory-page .views-exposed-widgets').prepend('<span class="search"></span>');
    $('#block-views-exp-list-directory-page .views-exposed-widgets .form-type-select').prepend('<span class="icon"></span>');
   
   $('.flexslider').flexslider({
            animation: "slide", 
            slideshowSpeed: 4000,
   });
   
   $('#edit-field-ser-category-und-0-tid-select-1 option[value="50"]').attr("selected",true);
   
   var url = window.location.pathname;
   if(url == '/list-directory'){
   var num = $('.views-row').length;
   if(num < 9){
    //$('.view-header').hide();
    $( "div.views-field-field-address-pro" ).addClass("shw");
   }
   }
  
  $('.node-directory .sponsored-ad .field-name-field-sponsored-upload').addClass('col-sm-9'); 
  $('.node-directory .sponsored-ad .field-name-field-picture').addClass('col-sm-3');
  $('.node-directory .sponsored-ad .field-type-fivestar').addClass('col-sm-3');
  $('.node-directory .sponsored-ad .field-type-addressfield').addClass('col-sm-3');
  $('.node-directory .sponsored-ad .field-name-field-phone-pro').addClass('col-sm-3');
  $('.node-directory .sponsored-ad .field-name-field-fax').addClass('col-sm-3');
  $('.node-directory .sponsored-out .field-name-field-picture').addClass('col-sm-3');
  $('.node-directory .sponsored-out .field-type-fivestar').addClass('col-sm-3');
  
  
  //Add Hover effect to menus
  $('ul.nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
  }, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
  });
  
    
   } 
  };

}(jQuery));
    
    
   