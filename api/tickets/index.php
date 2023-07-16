<?php 

    header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Content-Type: application/json');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    require_once('../../db_connect.php');

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == "GET"){
        $ticket_id = $_GET['ticket_id'];
        getTicket($ticket_id);
    }

    function getTicket($ticket_id){
        $fields = array(
            '`tickets`.`id`', 
            '`tickets`.`seat_number`', 
            '`tickets`.`show_date`', 
            '`movie`.`title` AS `movie_title`', 
            '`movie`.`description` AS `movie_description`', 
            '`users`.`first_name`' , 
            '`users`.`last_name`'
        );
        $sql1 = "SELECT " . implode(', ', $fields) . " FROM `tickets`";
        $sql2 = "INNER JOIN `movie` ON `tickets`.`movie_id` = `movie`.`id`";
        $sql3 = "INNER JOIN `users` ON `tickets`.`user_id` = `users`.`id`";
        $sql4 = "WHERE `tickets`.`id` = '$ticket_id'";
        $sql = $sql1 . $sql2 . $sql3 . $sql4;

        $result = performQuery($sql);

        if($result['success']){
            http_response_code(201);
            $ticket = $result['data']->fetch_assoc();
            echo json_encode($ticket);
        }
        else{
            http_response_code(500);
            $response = array('message' => 'Ticket not fetched');
            echo json_encode($response);
        }
        
        
    }
    
?>