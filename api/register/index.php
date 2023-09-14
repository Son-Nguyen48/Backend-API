<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');
require('../../config/database.php');
include_once('../../model/User.php');

$user = new User($connection);
// $title = "";
// $description = "";
// $project_id = "";
// $_POST = json_decode(file_get_contents("php://input"), true);
// $data = $_POST['dataForm'];
// echo json_encode($_POST['dataForm']);
// $data = json_decode(file_get_contents("php://input"), true);
// echo json_encode($data);
if (isset($_POST['email'])) {
    $formData = [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];
}

// // print_r($formData);
$user->register($formData);
