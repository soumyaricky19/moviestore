$(document).ready(function(){
	$.ajax({
		url: 'popular.php',
		type: 'GET',
		beforeSend: function() {
            $('div.popular.cover-container').addClass('loader').css("overflow-x","hidden");
        },
		success:function(data){
			var popular = document.querySelector('div.popular.cover-container');
            popular.style.opacity = 0;  
            setTimeout(function(){ 
                $('div.popular.cover-container').removeClass('loader').css("overflow-x","scroll").append(data);	
			    // Fade in
                popular.style.opacity = 1;
            },500);
		}
	});	
});