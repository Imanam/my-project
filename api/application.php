<?php

$dsn = 'mysql:host=localhost;dbname=my_project';
$db_user = 'root';
$db_pass = 'root';

// query to get all existing apps
$sql = 'SELECT a.name \'name\', a.description, c.name \'CatName\'from applications a INNER JOIN categories c ON c.id_category = a.id_category';


$json_result = [];

try {
    // get a connection to DB
    $pdo = new PDO($dsn, $db_user, $db_pass);
    // get user list by executing query
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json_result = json_encode($results);
} catch (PDOException $e) {
    exit('Failed to connect to database.' . $e->getMessage());
}
echo($json_result);

$method = $_SERVER['REQUEST_METHOD'];
