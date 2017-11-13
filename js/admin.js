$(document).ready(function() 
{
	// Add a new movie to the database
	$('#addBtn.btn-primary').click(function(e){
        window.location.href = "admin.php";
    });
    
    // Delete the movie from the database
    $(document).on("click", ".btn-danger", function(){
    	btnId = $(this).attr('id');
        movieId = btnId.substring(9);
		//Ajax call to delete the movie
		$.ajax({
			url: 'update_movie_admin.php',
			type: 'POST',
			data:  {movie_id: movieId, operation: "delete"},
			beforeSend: function() {
				$("#"+btnId).text('');
				$("#"+btnId).append("<i class='fa fa-refresh fa-spin'></i>Deleting");
			},
			success:function(data){
				var url = window.location.href;
				if(url.includes('description.php')){
					window.$_GET = new URLSearchParams(location.search);
					var movie_id = $_GET.get('id');	
					if(movie_id == movieId){
						alert(data+" Redirecting to home page.");
						window.location.href = 'home.php';
					}
				} else {
					alert(data);
					location.reload();	
				}											
			},
			error:function(err){
				alert(err);
			}
		});
	});

    // Update the movie details
    $(document).on("click", ".btn-success", function(){
        btnId = $(this).attr('id');
        movieId = btnId.substring(9);
        window.location.href = 'admin.php?movie_id='+movieId;
	});
});
	