<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


require_once('../../db_connect.php');

$method = $_SERVER['REQUEST_METHOD'];

if($method == "GET"){
    echo "this works";
}
if($method == "POST"){
    $user = $_POST;
    if(isset($user['username'])){
        loginUser($user);
        exit();
    }
}

    function loginUser($user){


        $username_or_email = $user['username'];
        $password = $user['password'];
        $sql = "SELECT * FROM users WHERE (username = '$username_or_email' OR email = '$username_or_email') AND password = '$password'";
        $result = performQuery($sql);

        if($result['success']){
            http_response_code(201);
            $user = $result['data']->fetch_assoc();
            $response = array('message' => 'User successfully logged in!', 'user' => $user);
            echo json_encode($response);
        }
        else{
            http_response_code(500);
            $response = array('message' => 'User not logged in!');
            echo json_encode($response);
        }
    }
?>