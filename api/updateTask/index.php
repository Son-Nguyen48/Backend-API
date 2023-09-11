<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header('Content-Type: application/json');
require('../../config/database.php');
include_once('../../model/Task.php');

$task = new Task($connection);
// $title = "";
// $description = "";
// $project_id = "";
// $_POST = json_decode(file_get_contents("php://input"), true);
// $data = $_POST['dataForm'];
// echo json_encode($_POST['dataForm']);
$data = json_decode(file_get_contents("php://input"), true);
// echo PHP_EOL . json_encode($data);
// foreach ($data as $key => $value) {
//     if ($key !== "id")
//         echo "$key : ?, ";
// }
// // print_r($formData);
$task->updateTask($data);
