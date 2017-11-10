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
			success:function(data){
				alert(data);
				location.reload();												
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
	