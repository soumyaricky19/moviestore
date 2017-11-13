$(document).ready(function(){
	$('div#addMovie').hide();		
	$.ajax({
		url: 'recent.php',
		type: 'GET',
		beforeSend: function() {
            $('div.recent.cover-container').addClass('loader');
        },
		success:function(data){
			var res = JSON.parse(data);
			var recent = document.querySelector('div.recent.cover-container');
            recent.style.opacity = 0;  
            setTimeout(function(){ 
                $('div.recent.cover-container').removeClass('loader');	
				$("div.recent.cover-container").append(res.content); 
				if(res.user == "admin"){
					$('div#addMovie').show();					
				}   
                // Fade in
                recent.style.opacity = 1;
            },500);
		}
	});	
});
