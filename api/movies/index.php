<?php
header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


require_once('./controllers.php');

session_start();

$method = $_SERVER['REQUEST_METHOD'];

// echo json_encode(array("data"=>$_SESSION));
// echo json_encode(array("request"=>$_SESSION, 'cookie'=>$_COOKIE, 'post'=>$_POST, 'get'=>$_GET, 'server'=>$_SERVER));

// if (!isset($_SESSION['user_id'])) {
    // header("Location: login.php");
    // http_response_code(401);
    // $response = array('message' => 'Unauthorized');
    // echo json_encode($response);
// }

if ($method == "GET") {
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $movie = getMovieById($id);
        echo json_encode($movie);
    }
    else{
        $movies = getMovieList();
        echo json_encode($movies);
    }

} else if ($method == "POST") {
    $movie = $_POST;
    if (isset($movie['title'])) {
        createMovie($movie);
        exit();
    }
}
 else if ($method == "PUT") {
    // $movie = $_GET;
    // if (isset($movie['id'])) {
    //     $id = $movie['id'];
    //     updateMovie($id, $movie);
    //     exit();
    // }
} else if ($method == "DELETE") {
    $movie = $_GET;
    if (isset($movie['id'])) {
        $id = $movie['id'];
        deleteMovie($id);
        exit();
    }
} else {
    echo json_encode(array('message' => 'Invalid request'));
}
