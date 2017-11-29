$(document).ready(function() {

    $("#movieDetails").submit(function(e) {

        var url = window.location.href;
        window.$_GET = new URLSearchParams(location.search);
		var movie_id = $_GET.get('movie_id');
        // Add new movie to the database
        if(movie_id == null){
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
		var movieTitle = $("#title").val();
		if(movieTitle == ""){
			alert("Please enter movie title in order to fetch the image link.");
			return;
		}
        $.ajax({
			url: 'fetchImage.php',
			type: 'POST',
			data:  {movie: movieTitle},
			beforeSend: function() {
				$('button#fetchImage').text('');
				$('button#fetchImage').append("<i class='fa fa-refresh fa-spin'></i>Fetching..");
			},
			success:function(data){
				$('button#fetchImage').text('Fetch Image Url');
				$("#img").val(data);
				if(data != "No image found for this movie."){
					$("#imagePreview").attr('src',data);
				} 
			},
			error:function(err){
				alert(err);
			}
		});
	});

	$('a#imgPreview').click(function(e){
		var imgLink = $("#img").val();
		if(imgLink == ""){
			alert("Please provide the image link to preview.")
			return false;
		}
		else if(imgLink == "No image found for this movie."){
			alert("No image to preview.")
			return false;
		} 
		else {
			$("#imagePreview").attr('src',imgLink);
		}
	});
    
});