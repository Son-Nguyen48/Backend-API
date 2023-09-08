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
        $section_id = $_POST['section_id'];
    }
}
$formData = [
    'title' => $title,
    'description' => $description,
    'section_id' => $section_id
];
// print_r($formData);
$task->addTaskInSection($formData);
