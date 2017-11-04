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
	$('.add').click(function(){
		alert("add");
		// $(this).val('Delete');
		// $(this).attr('class','del');
		var appendTxt = '<tr><td><input type="text" name="input_box_one[]" /></td><td><input type="text" name="input_box_two[]" /></td><td><input class="add" type="button" value="Add More" /></td></tr>';
		$("tr:last").after(appendTxt);
	});
	$('.del').click(function(){
		alert("del");
		$(this).parent().parent().remove();
	});
	
});
	