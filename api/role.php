<?php

$dsn = 'mysql:host=localhost;dbname=my_project';
$db_user = 'root';
$db_pass = 'root';

// query to get all existing apps
$sql = 'SELECT name, description from roles';

$json_result = [];

try {
    // get a connection to DB
    $pdo = new PDO($dsn, $db_user, $db_pass);
    // get role list by executing query
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json_result = json_encode($results);
} catch (PDOException $e) {
    exit('データベース接続失敗。' . $e->getMessage());
}
echo($json_result);

$method = $_SERVER['REQUEST_METHOD'];
