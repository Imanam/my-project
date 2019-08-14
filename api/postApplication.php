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


try {
    $conn = new PDO($dsn, $db_user, $db_pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $name = $data['applicationName'];
    $desc = $data['applicationDescription'];
    $category = $data['applicationCategory'];
    
    // check if the application exists
    $sql_check_application = "SELECT COUNT(*) FROM applications WHERE name = '$name'";
    $sql_insert_application = "INSERT INTO applications (name, description, category) VALUES ('$name', '$desc', '$category')";

    $res_check = $conn->query($sql_check_application);
    if ($res_check->fetchColumn() > 0) {
        // application with same name, description already exists. We refuse to re-create it
        $return = array("msg" => "Application already exists", "code" => "error");
    }
    else {
        // use exec() because no results are returned
        $conn->exec($sql_insert_application);
        $return = array("msg" => "Application has been created", "code" => "success");
    }
    echo(json_encode($return));
}
catch(PDOException $e) {
    exit('Failed to connect to database.' . $e->getMessage());
}

$conn = null;
?>