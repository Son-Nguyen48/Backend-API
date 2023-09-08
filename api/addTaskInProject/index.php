<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require('../../config/database.php');
include_once('../../model/Task.php');

$task = new Task($connection);
$title = "";
$description = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['title'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
    }
}
$data = [
    'title' => $title,
    'description' => $description
];
// print_r($data);
$task->addTaskInProject($data);
