<?php

$dsn = 'mysql:host=localhost;dbname=my_project';
$db_user = 'root';
$db_pass = 'root';

// query to get all users
$sql = 'SELECT name \'UserName\', email \'Email\', password \'Password\' from userlist';
// $sql = 'SELECT u.name \'UserName\', u.email \'Email\', r.name \'Role\', a.name \'Application\' from user_app_role INNER JOIN applications a ON user_app_role.id_app = a.application_id INNER JOIN userlist u ON user_app_role.id_user = u.id INNER JOIN roles r ON user_app_role.id_role = r.id_role';

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
