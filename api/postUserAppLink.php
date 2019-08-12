<?php
// return the value of $_POST 
header('Content-Type: application/json; charset=utf-8');
// echo json_encode(['name' => $_POST['name']]);
$request_body = file_get_contents("php://input");
$data = json_decode($request_body,true);

$dsn = 'mysql:host=localhost;dbname=my_project';
$db_user = 'root';
$db_pass = 'root';

$user_id = '';
$role_id = '';
$app_id = '';

$all_id_ok = true;

try {
    // get a connection to DB
    $pdo = new PDO($dsn, $db_user, $db_pass);

    // read params from request
    $appName = $data['appName'];
    $userNameAndMail = $data['userName'];
    $role = $data['role'];

    // from userName, extract name and mail
    $data = explode(' (' , rtrim($userNameAndMail, ')'));
    $name = $data[0];
    $email = $data[1];

    // sql select requests
    $sql_get_user_id = "SELECT id from userlist where name = '$name' and email = '$email'";
    $sql_get_app_id = "SELECT application_id from applications where name = '$appName'";
    $sql_get_role_id = "SELECT id_role from roles where name = '$role'";
    
    // get user id from name and e-mail
    $user_id_stmt = $pdo->prepare($sql_get_user_id);
    $user_id_stmt->execute();
    $colcount = $user_id_stmt->columnCount();
    var_dump($colcount);
    if ($colcount === 1) {
        while ($row = $user_id_stmt->fetch(PDO::FETCH_ASSOC)) {
            $user_id = $row["id"];
        }
    }
    else {
        $all_id_ok = false;
    }
    // get application id from application name
    $app_id_stmt = $pdo->prepare($sql_get_app_id);
    $app_id_stmt->execute();
    $colcount = $app_id_stmt->columnCount();
    var_dump($colcount);
    if ($colcount === 1) {
        while ($row = $app_id_stmt->fetch(PDO::FETCH_ASSOC)) {
            $app_id = $row["application_id"];
        }
    }
    else {
        $all_id_ok = false;
    }
    // get role id from role name
    $role_id_stmt = $pdo->prepare($sql_get_role_id);
    $role_id_stmt->execute();
    $colcount = $role_id_stmt->columnCount();
    var_dump($colcount);
    if ($colcount === 1) {
        while ($row = $role_id_stmt->fetch(PDO::FETCH_ASSOC)) {
            $role_id = $row["id_role"];
        }
    }
    else {
        $all_id_ok = false;
    }

    var_dump($all_id_ok);
    var_dump($sql_get_user_id);
    var_dump($sql_get_app_id);
    var_dump($sql_get_role_id);
    var_dump($name);
    var_dump($email);
    
    

    // check if we have 1 user id, 1 app id and 1 role id
    if ($all_id_ok) {
        // all is fine, we put the new relation into the DB
        $sql_insert_relation = "INSERT INTO user_app_role (id_app, id_user, id_role) VALUES ('$app_id', '$user_id', '$role_id')";
        $statement = $pdo->prepare($sql_insert_relation);
        $statement->execute();    
    }
} catch (PDOException $e) {
    exit('データベース接続失敗。' . $e->getMessage());
}

$method = $_SERVER['REQUEST_METHOD'];
