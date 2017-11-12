$(document).ready(function(){
	$(document).on("click", "div.cartButton button", function(){
		var val = this.id;
		var movieId = val.substring(3);
		var quantityId = "#qty"+movieId;
		var qtyValue = $(quantityId).val();

		alert("Hi"+quantityId);
		if(qtyValue == ""){
			qtyValue = $("[id=qty"+movieId+"]:eq(1)").val();
		}

		if(qtyValue == "" || qtyValue == "undefined"){
			alert("Please provide the quantity.")
		}
		else if(qtyValue < 0 || qtyValue == -0){
			alert("Please provide positive value for the quantity.")
			$(quantityId).val('');
		}
		else{
			alert("Hi"+qtyValue);	
			$.ajax({
				url: 'cart_update.php',
				type: 'POST',
				data:  {movie_id: movieId, quantity: qtyValue},
				success:function(data){
					var resp = JSON.parse(data);
					if(resp.message == "Cart Updated"){
						alert("Added to cart");	
					}
					else {
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