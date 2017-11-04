$(document).ready(function(){
    $.ajax({
        url: 'genre.php',
        type: 'GET',
        success:function(data){
            $("div.genre.cover-container").append(data);
        }
    });	
});
