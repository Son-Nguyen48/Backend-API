<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require('../../config/database.php');
include_once('../../model/Todo.php');

$todo = new Todo($connection);
$todo->id = isset($_GET['id']) ? $_GET['id'] : die();
$todo->getTaskDetail();
$todolist_item = [
    'id' => $todo->id,
    'title' => $todo->title,
    'isCompleted' => $todo->isCompleted,
    'isEditing' => $todo->isEditing,
    'isModalOpen' => $todo->isModalOpen,
    'idDuedate' => $todo->idDuedate,
    'dueDate' => $todo->dueDate
];
echo json_encode($todolist_item);
