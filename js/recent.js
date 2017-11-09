$(document).ready(function(){
	$('div#addMovie').hide();		
	$.ajax({
		url: 'recent.php',
		type: 'GET',
		success:function(data){
			var res = JSON.parse(data);
			$("div.recent.cover-container").append(res.content);
			if(res.user == "admin"){
				$('div#addMovie').show();					
			}
		}
	});	
});
