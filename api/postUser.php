<?php
// return the value of $_POST 
header('Content-Type: application/json; charset=utf-8');
// echo json_encode(['name' => $_POST['name']]);
$request_body = file_get_contents("php://input");
$data = json_decode($request_body,true);
// echo $data['email'];
// echo json_encode(['text' => $_POST['text']]);

$dsn = 'mysql:host=localhost;dbname=my_project';
$db_user = 'root';
$db_pass = 'root';

$return->msg = '';

try {
    $conn = new PDO($dsn, $db_user, $db_pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $email = $data['email'];
    $name = $data['userName'];
    $pwd = $data['password'];
    
    // check if the user exists
    $sql_check_user = "SELECT COUNT(*) FROM userlist WHERE name = '$name' and email = '$email'";
    $sql_insert_user = "INSERT INTO userlist (name, email, password) VALUES ('$name', '$email', '$pwd')";

    $res_check = $conn->query($sql_check_user);
    if ($res_check->fetchColumn() > 0) {
        // user with same name and mail already exists. We refuse to re-create it
        $return->code = 'error';
        $return->msg = 'Error - User already exists';
    }
    else {
        // use exec() because no results are returned
        $conn->exec($sql_insert_user);
        $return->code = 'success';
        $return->msg = 'Success - User has been created';
    }
    echo(json_encode($return));

}
catch(PDOException $e) {
    echo "<br>" . $e->getMessage();
}

$conn = null;
?>