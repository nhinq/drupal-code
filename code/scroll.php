 
        $('#').click(function(){      
            $("html, body").animate({scrollTop:$( $(this).attr('href') ).offset().top - 50}, 600);
            return false;
        });