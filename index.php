<!-- 
Random Thing API - v. 1.015
Script by © Michal Futera
https://linktr.ee/mjfutera 
-->

<?php
    require_once("liblary.php");
    
    header("Content-type: application/json; charset=UTF-8");
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); 
    header("Access-Control-Allow-Headers: Content-Type");

    $url = URLarray();
    $database = 'database.db';

    $result = array();
    $result['api_owner'] = 'Michal Futera';
    $result['api_owner_link'] = 'https://linktr.ee/mjfutera';

    if($url[2]=='joke') {
        $sql = 'SELECT joke FROM randomJoke ORDER BY RANDOM() LIMIT 1';
        $result['joke'] = connectSQLite($sql, $database)[0]['joke'];
        echo json_encode($result);
    } else if ($url[2]=='fact') {
        $sql = 'SELECT fact FROM randomFact ORDER BY RANDOM() LIMIT 1';
        $result['fact'] = connectSQLite($sql, $database)[0]['fact'];
        echo json_encode($result);
    } else if ($url[2]=='quote') {
        $sql = 'SELECT quote, author FROM randomQuote ORDER BY RANDOM() LIMIT 1';
        $result['quote'] = connectSQLite($sql, $database)[0];
        echo json_encode($result);
    } else {
        $result['message'] = 'Choose one random thing';
        $result['links']['joke'] = 'https://api.michalfutera.pro/random/joke';
        $result['links']['fact'] = 'https://api.michalfutera.pro/random/fact';
        $result['links']['quote'] = 'https://api.michalfutera.pro/random/quote';
        echo json_encode($result);
    }
        
?>