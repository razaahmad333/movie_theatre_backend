<?php

function openSQLConnection()
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "movie_theatre";

    // Establish database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function closeSQLConnection($conn)
{
    $conn->close();
}

function performQuery($sql)
{
    $conn = openSQLConnection();
    $result = $conn->query($sql);

    if ($result) {
        closeSQLConnection($conn);
        return array('success' => true, 'data' => $result);
    } else {
        $error = $conn->error;
        echo $error;
        closeSQLConnection($conn);
        return array('success' => false, 'error' => $error);
    }
}

?>
