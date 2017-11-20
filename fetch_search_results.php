<?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
    $user_id = $_SESSION["user_id"];
    $stop_list=array(",",";",":","a","about","above","after","again","against","all","am","an","and","any","are","aren't","as","at","be","because","been","before","being","below","between","both","but","by","can't","cannot","could","couldn't","did","didn't","do","does","doesn't","doing","don't","down","during","each","few","for","from","further","had","hadn't","has","hasn't","have","haven't","having","he","he'd","he'll","he's","her","here","here's","hers","herself","him","himself","his","how","how's","i","i'd","i'll","i'm","i've","if","in","into","is","isn't","it","it's","its","itself","let's","me","more","most","mustn't","my","myself","no","nor","not","of","off","on","once","only","or","other","ought","our","ours","ourselves","out","over","own","same","shan't","she","she'd","she'll","she's","should","shouldn't","so","some","such","than","that","that's","the","their","theirs","them","themselves","then","there","there's","these","they","they'd","they'll","they're","they've","this","those","through","to","too","under","until","up","very","was","wasn't","we","we'd","we'll","we're","we've","were","weren't","what","what's","when","when's","where","where's","which","while","who","who's","whom","why","why's","with","won't","would","wouldn't","you","you'd","you'll","you're","you've","your","yours","yourself","yourselves");
    $search_text = strtolower($_GET["search"]);
    $search_criteria = strtolower($_GET["criteria"]);
    $genre_id = $_GET["genre"];
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "onlinemoviestore";

    // Global List to store all the search results
    $totalSearchResults = array();
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $display_output="";
    $movie_list=array();
    $query_title="((select * from movie where is_available=1 and title ";
    $query_director="((select * from movie where is_available=1 and director ";
    $query_actor="select * from movie where is_available=1 and movie_id in (select movie_id from movie_actor where actor_id in (select actor_id from actors where actor_name ";

    // Empty Search
    if ($search_text == " ") {
        echo "<script> alert('Please enter some string to search')</script>";
        return;
    }   
    // Movie Search                     
    else if ($search_text != "" || $genre_id == "")
    {
        $tokens=tokenize($search_text);
        $entire_text="";
        foreach($tokens as $token) {
            $entire_text=$entire_text."%".$token."%";
        }
        switch ($search_criteria) {
            case "title":
                $display_output=$display_output.form_output($conn,form_query($query_title,$entire_text));
                break;
            case "actor":
                $display_output=$display_output.form_output($conn,form_query($query_actor,$entire_text));
                break;
            case "director":
                $display_output=$display_output.form_output($conn,form_query($query_director,$entire_text));
                break;
            default:
                $display_output=$display_output.form_output($conn,form_query($query_title,$entire_text));
                $display_output=$display_output.form_output($conn,form_query($query_director,$entire_text));
                $display_output=$display_output.form_output($conn,form_query($query_actor,$entire_text));
        } 
        foreach($tokens as $token) {
            if (!in_array($token,$stop_list))
            {   
                switch ($search_criteria) {
                    case "title":
                        $display_output=$display_output.form_output($conn,form_query($query_title,$token));
                        break;
                    case "actor":
                        $display_output=$display_output.form_output($conn,form_query($query_actor,$token));
                        break;
                    case "director":
                        $display_output=$display_output.form_output($conn,form_query($query_director,$token));
                        break;
                    default:
                        $display_output=$display_output.form_output($conn,form_query($query_title,$token));
                        $display_output=$display_output.form_output($conn,form_query($query_actor,$token));
                        $display_output=$display_output.form_output($conn,form_query($query_director,$token));
                }
            }
        }
    }
    // Genre Based Search
    else if ($search_text == "" || $genre_id != "")
    {
        $query_genre="select * from movie where is_available=1 and movie_id in (select movie_id from movie_genre where genre_id=".$genre_id.")";
        $display_output=$display_output.form_output($conn,$query_genre);
    }
    
    echo json_encode($totalSearchResults);

    function form_output($conn,$query) {
        $result = mysqli_query($conn,$query);
        $list="";
        global $movie_list, $totalSearchResults;

        while ($row = mysqli_fetch_array($result)){
            if (!in_array($row['movie_id'], $movie_list)) {
                array_push($movie_list,$row['movie_id']);
                $img = "<a href='description.php?id=".$row['movie_id']."'><img src='" .$row['imageUrl']. "' alt='Image not found' title='".$row['title']."' /></a>";     
                
                if($_SESSION["user_id"] == "admin"){
                    $img = $img."<div class='adminButton'><button id='updateBtn".$row['movie_id']."' type ='button' class='btn btn-success'>Update</button>&nbsp;&nbsp;&nbsp;";
                    $img = $img."<button id='deleteBtn".$row['movie_id']."' type ='button' class='btn btn-danger'>Delete</button></div>";
                } else{
                    $img = $img."<div class='detailContainer'><div><span>Price: $".$row['price']." &nbsp;&nbsp;&nbsp;Qty: <input type='number' id='qty".$row['movie_id']."' min='1' max='".$row['quantity']."' required></span></div>";
                    $img = $img."<div class='cartButton'><button type='button' id='btn".$row['movie_id']."'>Add to Cart</button></div></div>";
                }
                $list="<div class='cover-item'>".$img."</div>";
                array_push($totalSearchResults,$list);
            }
            
        }
        //return $list;
        //return $totalSearchResults;
    }
    function form_query($query,$search_token) {
        return $query." like '%".$search_token."%'))";
    }

    function tokenize($search_text)
    {
        $tokens = explode(" ",$search_text); 
        return $tokens;
    }
?>