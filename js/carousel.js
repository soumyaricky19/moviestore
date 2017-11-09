$(document).ready(function(){
    $.ajax({
        url: 'carousel.php',
        type: 'GET',
        success:function(data){
            //var resp = JSON.parse(data);			
            $("div.carousel-inner").append(data);
            //if(resp.button != null){
              //  $("div#myCarousel").append(resp.button);    
            //}
        }
    });	
});
