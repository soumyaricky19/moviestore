$(document).ready(function() 
{
	$("#btn").click(function () {
		$.ajax({
			url: 'add_cart.php',
			type: 'POST',
			data:  {movie_id: $("#m").val() , quantity: $("#q").val()},
			success:function(data){
                alert(data);
                // alert("Added to cart");
				$("#add_btn").hide();			
			}
		});	
	});

	$('.btn-number').click(function(e){
		e.preventDefault();	
		btnId = $(this).attr('id');
		movieId = btnId.substring(3);
		fieldName = $(this).attr('data-field');
		type      = $(this).attr('data-type');
		var input = $("input#inp"+movieId);
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
				//alert("Movie id: "+movieId);
				//alert("Quantity: " + $(quantityId).val());
				//$("#"+this.id).text("Added");		
				//$(quantityId).val("");
				location.reload();												
			},
			error:function(err){
				alert(err);
			}
		});
	});

});
	