<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');
require('../../config/database.php');
include_once('../../model/Task.php');

$task = new Task($connection);
$data = json_decode(file_get_contents("php://input"), true);

$formData = [
    'title' => $data['title'],
    'description' => $data['description'],
    'section_id' => $data['id']
];
// print_r($formData);
$task->addTaskInSection($formData, $data);
