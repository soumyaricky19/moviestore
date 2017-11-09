$(document).ready(function() {

    $("#movieDetails").submit(function(e) {
        var url = window.location.href;
        window.$_GET = new URLSearchParams(location.search);
        var movie_id = $_GET.get('movie_id');
        alert(movie_id);
        // Add new movie to the database
        if(url == "http://localhost/admin.php"){
            $.ajax({
				url: 'update_movie_admin.php',
				type: 'POST',
				data:  {operation: "add", title: $("#title").val(), description: $("#descr").val(), director: $("#director").val(), year: $("#year").val(), image: $("#img").val(), duration: $("#duration").val(), rating: $("#rating").val(), votes: $("#votes").val(), quantity: $("#qty").val(),price: $("#price").val()},
				success:function(data){
					alert(data);												
				},
				error:function(err){
					alert(err);
				}
			});
        } 
        // Update existing movie
        else {
            alert("update");
            $.ajax({
				url: 'update_movie_admin.php',
				type: 'POST',
				data:  {operation: "update", movie_id: movieId, title: $("#title").val(), description: $("#descr").val(), director: $("#director").val(), year: $("#year").val(), image: $("#img").val(), duration: $("#duration").val(), rating: $("#rating").val(), votes: $("#votes").val(), quantity: $("#qty").val(),price: $("#price").val()},
				success:function(data){
					alert(data);												
				},
				error:function(err){
					alert(err);
				}
			});
        }
    });
});