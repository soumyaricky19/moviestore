$(document).ready(function() {

    $("#movieDetails").submit(function(e) {

        var url = window.location.href;
        window.$_GET = new URLSearchParams(location.search);
        var movie_id = $_GET.get('movie_id');
        // Add new movie to the database
        if(url == "http://localhost/admin.php"){
            $.ajax({
				url: 'update_movie_admin.php',
				type: 'POST',
				data:  {operation: "add", title: $("#title").val(), description: $("#descr").val(), director: $("#director").val(), year: $("#year").val(), image: $("#img").val(), duration: $("#duration").val(), rating: $("#rating").val(), votes: $("#votes").val(), quantity: $("#qty").val(),price: $("#price").val()},
				success:function(data){
                    alert(data);		
                    window.location.href = "home.php";										
				},
				error:function(err){
					alert(err);
				}
			});
        } 
        // Update existing movie
        else {
            $.ajax({
				url: 'update_movie_admin.php',
				type: 'POST',
				data:  {operation: "update", movie_id: movie_id, title: $("#title").val(), description: $("#descr").val(), director: $("#director").val(), year: $("#year").val(), image: $("#img").val(), duration: $("#duration").val(), rating: $("#rating").val(), votes: $("#votes").val(), quantity: $("#qty").val(),price: $("#price").val()},
				success:function(data){
                    alert(data);
                    window.location.href = "home.php";										
				},
				error:function(err){
					alert(err);
				}
			});
        }
	});
	
	// Fetch image url from the API
	$('button#fetchImage').click(function(e){
        $.ajax({
			url: 'fetchImage.php',
			type: 'POST',
			data:  {movie: $("#title").val()},
			beforeSend: function() {
				$('button#fetchImage').text('');
				$('button#fetchImage').append("<i class='fa fa-refresh fa-spin'></i>Fetching..");
			},
			success:function(data){
				alert(data);
				if(data == "No image found for this movie."){
					$('button#fetchImage').text('Not found');
				}
				else {
					$('button#fetchImage').text('Success');
				}
				$("#img").val(data);
			},
			error:function(err){
				alert(err);
			}
		});
    });
    
});