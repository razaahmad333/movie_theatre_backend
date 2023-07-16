    <?php 
    header('Access-Control-Allow-Origin: *');

    require_once('../../db_connect.php');

    $method = $_SERVER['REQUEST_METHOD'];

if($method == "GET"){
    echo "this works";
}

if($method == "POST"){
    $user = $_POST;
    if(isset($user['username'])){
        createUser($user);
        exit();
    }
}


function createUser($user){
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $username = $user['username'];
    $email = $user['email'];
    $password = $user['password'];

    $sql = "INSERT INTO users (first_name, last_name, username, email, password) VALUES ('$first_name', '$last_name', '$username', '$email', '$password')";
    $result = performQuery($sql);

    if($result['success']){
        http_response_code(201);
        $response = array('message' => 'User successfully created!');
        echo json_encode($response);
    }
    else{
        http_response_code(500);
        $response = array('message' => 'User not created!');
        echo json_encode($response);
    }

}

?>