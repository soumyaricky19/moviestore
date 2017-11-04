$(document).ready(function(){
    $.ajax({
        url: 'carousel.php',
        type: 'GET',
        success:function(data){
            $("div.carousel-inner").append(data);
        }
    });	
});
