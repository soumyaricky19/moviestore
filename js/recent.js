$(document).ready(function(){
		$.ajax({
			url: 'recent.php',
			type: 'GET',
			success:function(data){
				$("div.recent.cover-container").append(data);
			}
		});	
});
