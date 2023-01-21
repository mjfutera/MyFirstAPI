<!-- 
Random Thing API - v. 1.015
Script by © Michal Futera
https://linktr.ee/mjfutera 
-->

<?php
    function URLarray ($url = NULL) {
        if ($url===NULL) {$url = $_SERVER['REQUEST_URI']; }
        return explode("/", parse_url($url, PHP_URL_PATH));
    }

    function connectSQLite($sql, $file) {
        $pdo = new PDO('sqlite:'.$file);
        $statement = $pdo->query($sql);
        $rows = $statement -> fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
?>