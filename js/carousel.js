$(document).ready(function(){
    $.ajax({
        url: 'carousel.php',
        type: 'GET',
        beforeSend: function() {
            $('div.carousel-inner').addClass('loader');
        },
        success:function(data){
            var carousel = document.querySelector('div.carousel-inner');
            carousel.style.opacity = 0;  
            setTimeout(function(){ 
                $('div.carousel-inner').removeClass('loader');	
                $("div.carousel-inner").append(data);    
                // Fade in
                carousel.style.opacity = 1;
            },500);
        }
    });	
});
