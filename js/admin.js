$(document).ready(function() 
{
	// Add a new movie to the database
	$('#addBtn.btn-primary').click(function(e){
        alert("Add");
        window.location.href = "admin.php";
    });
    
    // Delete the movie from the database
    $(document).on("click", ".btn-danger", function(){
    	btnId = $(this).attr('id');
        movieId = btnId.substring(9);
        alert(movieId);
		// Ajax call to update cart
		// $.ajax({
		// 	url: 'cart_update.php',
		// 	type: 'POST',
		// 	data:  {movie_id: movieId, quantity: 0 ,operation: "delete"},
		// 	success:function(data){
		// 		var resp = JSON.parse(data);
		// 		//alert(resp.message);
		// 		if(resp.message == "Cart Updated"){	
		// 			location.reload();	
		// 		} 
		// 		else {
		// 			alert("SQL Error. Reverting back the changes.");
		// 		}											
		// 	},
		// 	error:function(err){
		// 		alert(err);
		// 	}
		// });
	});

    // Update the movie details
    $(document).on("click", ".btn-success", function(){
        btnId = $(this).attr('id');
        movieId = btnId.substring(9);
        window.location.href = 'admin.php?movie_id='+movieId;
	});
});
	