        <?php 

        header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Content-Type: application/json');
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

            require_once('../../db_connect.php');

            $method = $_SERVER['REQUEST_METHOD'];
            if($method == "GET"){
                echo "Hii from GET";
            }
            if($method == "POST"){
                $json = file_get_contents('php://input');
                $tickets = json_decode($json, true);
                bookTickets($tickets);
            }

            function bookTickets($tickets){
                $sql = "INSERT INTO `tickets` (`id`, `user_id`, `movie_id`, `seat_number`, `show_date`) VALUES ";

                $params = [];
                foreach ($tickets as $ticket) {
                $uuid = uniqid(); 
                $params[] = "('$uuid', '{$ticket['user_id']}', '{$ticket['movie_id']}', '{$ticket['seat_number']}', '{$ticket['show_date']}')";
                }
            
                $sql .= implode(", ", $params);  
                $result = performQuery($sql);

                if($result['success']){
                    http_response_code(201);
                    $response = array('message' => 'Tickets booked');
                    echo json_encode($response);
                }
                else{
                    http_response_code(500);
                    $response = array('message' => 'Tickets not booked');
                    echo json_encode($response);
                }
            }

        ?>