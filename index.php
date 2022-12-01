<?php
    require_once("connect_db.php");
    require_once("liblary.php");
    
    header("Content-type: application/json; charset=UTF-8");
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); 
    header("Access-Control-Allow-Headers: Content-Type");

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $result = array();
        $result['API_Owner'] = 'Michal Futera';
        $result['API_Owner_Link'] = 'https://linktr.ee/mjfutera';
        if (!$_GET) {
            $sql='SELECT joke.joke, joke.joke_id, categories.category FROM joke, categories WHERE joke.joke_category=categories.category_id ORDER BY RAND() LIMIT 1';          
            $api_result = dbToArray(connectDB($sql, $db_details));
            $result['Joke'] = $api_result[0]['joke'];
            $result['Joke_Category'] = $api_result[0]['category'];
            $result['Joke_Link'] = "http://jokeapi.mjblog.ovh/?joke_id=".$api_result[0]['joke_id'];
            echo json_encode($result);
            exit();
        } else if ($_GET['joke_id']){
            $get = $_GET['joke_id'];
            $sql='SELECT joke.joke, joke.joke_id, categories.category FROM joke, categories WHERE joke.joke_id=$get AND joke.joke_category=categories.category_id';
            
            $api_result = dbToArray(connectDB($sql, $db_details));
            if (count($api_result)>0) {
                $result['Joke'] = $api_result[0]['joke'];
                $result['Joke_Category'] = $api_result[0]['category'];
                $result['Joke_Link'] = "http://jokeapi.mjblog.ovh/?joke_id=".$api_result[0]['joke_id'];
                echo json_encode($result);
                exit();
            } else {
                http_response_code(404);
                $result['Status'] = 404;
                $result['Message'] = 'No joke under id '.$get;
                echo json_encode($result);
                exit();
            }
        }
    } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
        echo json_encode($_SERVER['REQUEST_METHOD']);
        // $data = json_decode(file_get_contents('php://input'), true);
    } else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
        echo json_encode($_SERVER['REQUEST_METHOD']);
    } else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        echo json_encode($_SERVER['REQUEST_METHOD']);
    }
?>