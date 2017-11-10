<?php
    class MovieDB { 	
        private $apiKey; 
        public function __construct($apikey = null) {
            $this->apiKey = $apikey;
        } 

        public function search($value) {     
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.themoviedb.org/3/configuration?api_key=ba4413f4006dc9879b9dd608bc18303a",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_POSTFIELDS => "{}",
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);      
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              #echo $response;
            }   
      
            $config = json_decode($response, true);
            //$base = $config['images']['base_url'];
            #echo $base;
            #echo "<br>";      

            $curl = curl_init();
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            #$value = "The Godfather";
            $value = str_replace(" ","+",$value);
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?query=".$value."&api_key=ba4413f4006dc9879b9dd608bc18303a",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "{}",
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            $result = json_decode($response, true);
            
            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return array($config,$result);
            }
            
        } 
    }
    
    $movie = $_POST["movie"];
    $MovieDB = new MovieDB('ba4413f4006dc9879b9dd608bc18303a'); 
    $data = $MovieDB->search($movie); 
    
    $config = $data[0];
    $result = $data[1];
    if (!empty($result['results'][0]['poster_path'])) {
        //return "<img src='" . $config['images']['base_url'] . $config['images']['poster_sizes'][2] . $result['results'][0]['poster_path'] . "' alt='Image not found'/>";
        
        echo "" . $config['images']['base_url'] . $config['images']['poster_sizes'][2] . $result['results'][0]['poster_path'] . "";
        
    } else {
        #echo '<p>There are no photos for this keyword.</p>';
        
        echo "No image found for this movie.";
    }
    
?>