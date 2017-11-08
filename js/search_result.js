$(document).ready(function(){
    
    window.$_GET = new URLSearchParams(location.search);
    var search = $_GET.get('search');
    var genre = $_GET.get('genre');
    var urlValue = "";
    if( search == null && genre != null){
        urlValue = 'fetch_search_results.php?genre='+genre;
    }
    else if( search != null && genre == null){
        urlValue = 'fetch_search_results.php?search='+search;
    }
    var movieResults = "";
    var totalMovies = 0;

    // Fetch movies search results
    $.ajax({
        url: urlValue,
        type: 'GET',
        beforeSend: function() {
            $('div.orderbutton').hide();
            $('#searchResults').addClass('loader');
        },
        success:function(data){
            var searchContainer = document.querySelector('#searchResults');
            searchContainer.style.opacity = 0;  
            
            movieResults = JSON.parse(data)
            totalMovies = movieResults.length;
            
            var content = "";
            for(i = 0; i < 6; i++){
                if(i == totalMovies){
                    $("#nxtBtn").prop('disabled',true);
                    break;
                }
                content = content + movieResults[i];          
            }
            $("#prBtn").prop('disabled',true);       
            if(i == totalMovies){
                $("#nxtBtn").prop('disabled',true);
            }

            setTimeout(function(){ 
                // Load new content
                $('#searchResults').removeClass('loader');
                $('#searchResults').html(content); 
                $('div.orderbutton').show();    
                // Fade in
                searchContainer.style.opacity = 1;
            },500);
        }
    });	

    $("#nxtBtn").click(function(){
        
        var searchContainer = document.querySelector('#searchResults');
        searchContainer.style.opacity = 0;
        $("#prBtn").removeAttr('disabled');
        this.value = parseInt(this.value) + 1;
        $("#prBtn").val(this.value);
        
        var content = "";
        for(i = 6*this.value; i < (6*this.value+6); i++){
          if(i == totalMovies){
            $("#nxtBtn").prop('disabled',true);
            break;
          }
          content = content + movieResults[i];
        }
        if(i == totalMovies){
            $("#nxtBtn").prop('disabled',true);
        }
        setTimeout(function(){ 
            // Load new content
            $('#searchResults').html(content);     
            // Fade in
            searchContainer.style.opacity = 1;
        },500);
      });
    
      $("#prBtn").click(function(){
        var searchContainer = document.querySelector('#searchResults');
        searchContainer.style.opacity = 0;
        
        $("#nxtBtn").removeAttr('disabled');
        this.value = parseInt(this.value) - 1;
        $("#nxtBtn").val(this.value);
        
        var content = "";
        for(i = 6*this.value; i < (6*this.value+6); i++){
            content = content + movieResults[i];
        }
        if(this.value == 0){
          $("#prBtn").prop('disabled',true);
        }
        
        setTimeout(function(){ 
          // Load new content
          $('#searchResults').html(content);     
          // Fade in
          searchContainer.style.opacity = 1;
        },500);
      });

});
