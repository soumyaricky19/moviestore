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
				url: 'cart_update.php',
				type: 'POST',
				data:  {movie_id: movieId, quantity: $(quantityId).val()},
				success:function(data){
					var resp = JSON.parse(data);
					if(resp.message == "Cart Updated"){
						alert("Added to cart");	
					}
					else
					{
						alert(resp.message);
					}
					var x ='';
					$.ajax({
					type: "POST",
					url: "num_cart.php",
					success: function(num) {
						$("#cart").empty();
						$("#cart").append("<a href='cart.php'>Cart ("+ num + " ) </a>");	
					}
					});															
				},
				error:function(err){
					alert(err);
				}
			});
		}
	});
});