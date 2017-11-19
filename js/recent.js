$(document).ready(function(){
	$.ajax({
		url: 'recent.php',
		type: 'GET',
		beforeSend: function() {
			$('div.recent.cover-container').addClass('loader').css("overflow-x","hidden");
        },
		success:function(data){
			var res = JSON.parse(data);
			var recent = document.querySelector('div.recent.cover-container');
			recent.style.opacity = 0;  
            setTimeout(function(){ 
				$('div.recent.cover-container').removeClass('loader').css("overflow-x","scroll").append(res.content);	
				// Fade in
                recent.style.opacity = 1;
            },500);
		}
	});	
});
