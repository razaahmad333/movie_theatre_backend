<?php 

header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

    require_once('../../db_connect.php');

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == "GET"){
        $user_id = $_GET['user_id'];
        getMyTickets($user_id);
    }

    function getMyTickets($user_id){
        // join movie table and get the name of movie and dscription
        $sql = "SELECT `tickets`.`id`, `tickets`.`seat_number`, `tickets`.`show_date`, `movie`.`title` AS `movie_title`, `movie`.`description` AS `movie_description`  FROM `tickets` INNER JOIN `movie` ON `tickets`.`movie_id` = `movie`.`id` WHERE `tickets`.`user_id` = '$user_id'";
        $result = performQuery($sql);

        if($result['success']){
            http_response_code(201);
            $tickets = [];
            while($row = $result['data']->fetch_assoc()){
                $tickets[] = $row;
            }
            echo json_encode($tickets);
        }
        else{
            http_response_code(500);
            $response = array('message' => 'Tickets not fetched');
            echo json_encode($response);
        }
    }
    
?>