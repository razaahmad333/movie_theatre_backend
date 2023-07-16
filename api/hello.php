<?php 
    header("Access-Control-Allow-Origin: *");

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == "GET"){
        echo "Hello this is me woow";
    }
    else if($method == "POST"){
        echo "This is a post request";
    }
    else if($method == "PUT"){
        echo "This is a put request";
    }
    else if($method == "DELETE"){
        echo "This is a delete request";
    }
    else{
        echo "This is an invalid request";
    }
?>