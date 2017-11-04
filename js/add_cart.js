$(document).ready(function(){

	$(document).on("click", "div.cartButton button", function(){
		var val = this.id;
		var movieId = val.substring(3);
		var quantityId = "#qty"+movieId;

		if($(quantityId).val() == ""){
			alert("Please provide the quantity.")
		}
		else{		
			$.ajax({
				url: 'add_cart.php',
				type: 'POST',
				data:  {movie_id: movieId, quantity: $(quantityId).val()},
				success:function(data){
					//alert("Movie id: "+movieId);
					//alert("Quantity: " + $(quantityId).val());
					//$("#"+this.id).text("Added");		
					//$(quantityId).val("");
					alert(data);												
				},
				error:function(err){
					alert(err);
				}
			});
		}
	});
});