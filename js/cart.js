$(document).ready(function() 
{
	// Update Cart and Interface based on plus and minus qunatity value
	$('.btn-number').click(function(e){
		e.preventDefault();	
		btnId = $(this).attr('id');
		movieId = btnId.substring(3);
		fieldName = $(this).attr('data-field');
		type      = $(this).attr('data-type');
		var input = $("input#inp"+movieId);
		var price = $("p#p"+movieId);
		var currentVal = parseInt(input.val());
		if (!isNaN(currentVal)) {
			if(type == 'minus') {
				if(currentVal > input.attr('min')) {
					input.val(currentVal - 1).change();
					// Ajax call to update cart
					$.ajax({
						url: 'cart_update.php',
						type: 'POST',
						data:  {movie_id: movieId, quantity: parseInt(input.val()), operation: "update"},
						success:function(data){
							var resp = JSON.parse(data);
							//alert(resp.message);			
							if(resp.message == "Cart Updated"){	
								price.text("$"+resp.price);
								var totalQty = 0;
								
								//Update total Quantity
								$(".input-number").each(function(index){
									totalQty += parseInt($(this).val());
								});
								$("div#totalQty.total").text(totalQty);
								
								//Update total Price
								var totalPrice = 0
								$(".price").each(function(index){
									totalPrice += parseInt($(this).text().substring(1));
								});
								$("div#totalPrice.total").text("$"+totalPrice);	
								var x ='';
								$.ajax({
								type: "POST",
								url: "num_cart.php",
								success: function(num) {
									$("#cart").empty();
									$("#cart").append("<a href='cart.php'>Cart ("+ num + " ) </a>");	
								}
								});	
							} 
							else {
								alert("SQL Error-"+resp.message+" Reverting back the changes.");
								input.val(currentVal).change();
							}
						},
						error:function(err){
							alert(err);
						}
					});
				} 
				if(parseInt(input.val()) == input.attr('min')) {
					$(this).attr('disabled', true);
				}
			} else if(type == 'plus') {
				if(currentVal < input.attr('max')) {
					input.val(currentVal + 1).change();
					// Ajax call to update cart
					$.ajax({
						url: 'cart_update.php',
						type: 'POST',
						data:  {movie_id: movieId, quantity: parseInt(input.val()), operation: "update"},
						success:function(data){
							var resp = JSON.parse(data);
							//alert(resp.message);
							if(resp.message == "Cart Updated"){	
								price.text("$"+resp.price);
								var totalQty = 0;
								
								//Update total Quantity
								$(".input-number").each(function(index){
									totalQty += parseInt($(this).val());
								});
								$("div#totalQty.total").text(totalQty);
								
								//Update total Price
								var totalPrice = 0
								$(".price").each(function(index){
									totalPrice += parseInt($(this).text().substring(1));
								});
								$("div#totalPrice.total").text("$"+totalPrice);	
								var x ='';
								$.ajax({
								type: "POST",
								url: "num_cart.php",
								success: function(num) {
									$("#cart").empty();
									$("#cart").append("<a href='cart.php'>Cart ("+ num + " ) </a>");	
								}
								});
							} 
							else {
								alert("SQL Error-"+resp.message+" Reverting back the changes.");
								input.val(currentVal).change();
							}
						},
						error:function(err){
							alert(err);
							location.reload();
						}
					});
				}
				if(parseInt(input.val()) == input.attr('max')) {
					$(this).attr('disabled', true);
				}	
			}
		} else {
			input.val(0);
		}
	});
	$('.input-number').focusin(function(){
		$(this).data('oldValue', $(this).val());
	});
	$('.input-number').change(function() {	 
		 minValue =  parseInt($(this).attr('min'));
		 maxValue =  parseInt($(this).attr('max'));
		 valueCurrent = parseInt($(this).val());
		 
		 name = $(this).attr('name');
		 if(valueCurrent >= minValue) {
			 $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
		 } else {
			 alert('Sorry, the minimum value was reached');
			 $(this).val($(this).data('oldValue'));
		 }
		 if(valueCurrent <= maxValue) {
			 $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
		 } else {
			 alert('Sorry, the maximum value was reached');
			 $(this).val($(this).data('oldValue'));
		 }	 
	 });

	 $('.input-number').focusout(function(){
		var inputId = $(this).attr('id');
		var movieId = inputId.substring(3);
		var value = parseInt($(this).val());
		var price = $("p#p"+movieId);
		//Ajax call to update cart
		$.ajax({
			url: 'cart_update.php',
			type: 'POST',
			data:  {movie_id: movieId, quantity: value, operation: "update"},
			success:function(data){
				var resp = JSON.parse(data);
				//alert(resp.message);			
				if(resp.message == "Cart Updated"){	
					price.text("$"+resp.price);
					var totalQty = 0;
					
					//Update total Quantity
					$(".input-number").each(function(index){
						totalQty += parseInt($(this).val());
					});
					$("div#totalQty.total").text(totalQty);
					
					//Update total Price
					var totalPrice = 0
					$(".price").each(function(index){
						totalPrice += parseInt($(this).text().substring(1));
					});
					$("div#totalPrice.total").text("$"+totalPrice);	
					var x ='';
					$.ajax({
					type: "POST",
					url: "num_cart.php",
					success: function(num) {
						$("#cart").empty();
						$("#cart").append("<a href='cart.php'>Cart ("+ num + " ) </a>");	
					}
					});	
				} 
				else {
					alert("SQL Error-"+resp.message+" Reverting back the changes.");
					input.val(currentVal).change();
				}
			},
			error:function(err){
				alert(err);
			}
		});
	});

	//Update the cart when removing a movie 
	$('.btn-danger').click(function(e){
		e.preventDefault();	
		btnId = $(this).attr('id');
		movieId = btnId.substring(3);
		// Ajax call to update cart
		$.ajax({
			url: 'cart_update.php',
			type: 'POST',
			data:  {movie_id: movieId, quantity: 0 ,operation: "delete"},
			success:function(data){
				var resp = JSON.parse(data);
				//alert(resp.message);
				if(resp.message == "Cart Updated"){	
					location.reload();	
					var x ='';
					$.ajax({
					type: "POST",
					url: "num_cart.php",
					success: function(num) {
						$("#cart").empty();
						$("#cart").append("<a href='cart.php'>Cart ("+ num + " ) </a>");	
					}
					});
				} 
				else {
					alert("SQL Error-"+resp.message+" Reverting back the changes.");
				}											
			},
			error:function(err){
				alert(err);
			}
		});
	});

	// Purchase the movies in the cart
	$('.btn-success').click(function(e){
		$.ajax({
			url: 'purchase.php',
			type: 'POST',
			success:function(data){
				alert(data);
				if (data == " Order placed succesfully!") {
					window.location.href = "order_history.php";
				} else if (data == " Please login before continuing") {
					window.location.href = "login_page.php";
				}						
			},
			error:function(err){
				alert(err);
			}
		});
	});
});
	