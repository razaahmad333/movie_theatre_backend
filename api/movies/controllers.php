<?php

require_once('../../db_connect.php');

function getMovieList(){
    $sql = "SELECT * FROM movie";
    $result = performQuery($sql);
    $movies = array();

    if($result['success']){
        while($row = $result['data']->fetch_assoc()){
            array_push($movies, $row);
        }   
    }
    return $movies;
}

function getMovieById($id){
    // $sql = "SELECT * FROM movie WHERE id = $id";
    // $result = performQuery($sql);
    // $movie = array();
    // if($result->num_rows > 0){
    //     while($row = $result->fetch_assoc()){
    //         $movie = $row;
    //     }
    // }
    // return $movie;
}

function createMovie($movie)
{
    $title = $movie['title'];
    $description = $movie['description'];
    $release_date = $movie['release_date'];
    $image_url = $movie['image_url'];

    $sql = "INSERT INTO movie (title,image_url, description, release_date) VALUES ('$title', '$image_url', '$description', '$release_date')";
    $result = performQuery($sql);

    if ($result['success']) {
        http_response_code(201);
        $response = array('message' => 'Movie created', 'data' => $movie);
        echo json_encode($response);
    } else {
        http_response_code(500);
        $response = array('message' => 'Movie not created');
        echo json_encode($response);
    }
}

function deleteMovie($movie_id){
    $sql = "DELETE FROM movie WHERE id = $movie_id";
    $result = performQuery($sql);
    if($result['success']){
        http_response_code(200);
        $response = array('message' => 'Movie deleted');
        echo json_encode($response);
    }
    else{
        http_response_code(500);
        $response = array('message' => 'Movie not deleted');
        echo json_encode($response);
    }
}

?>