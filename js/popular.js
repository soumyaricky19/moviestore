$(document).ready(function(){
	$.ajax({
		url: 'popular.php',
		type: 'GET',
		success:function(data){
			//$("#popular").empty();
			$("div.popular.cover-container").append(data);
		}
	});	
});