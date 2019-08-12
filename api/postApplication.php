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
    
    $sql = "INSERT INTO applications (name, description, category) VALUES ('$name', '$desc', '$category')";
    $conn->exec($sql);
    echo "New application created successfully";
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>