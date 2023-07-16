<?php 

header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

    require_once('../../db_connect.php');

    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "GET"){
        $movie_id = $_GET['movie_id'];
        $show_date = $_GET['show_date'];
        getBookedSeats($movie_id, $show_date);
    }

    function getBookedSeats($movie_id, $show_date){
        $sql = "SELECT `seat_number` FROM `tickets` WHERE  `movie_id` = '$movie_id' AND `show_date` = '$show_date'";
        $result = performQuery($sql);

        if($result['success']){
            http_response_code(201);
            $seats = [];
            while($row = $result['data']->fetch_assoc()){
                $seats[] = $row;
            }
            echo json_encode($seats);
        }
        else{
            http_response_code(500);
            $response = array('message' => 'Seats not fetched');
            echo json_encode($response);
        }
    }
   
?>