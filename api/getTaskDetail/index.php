<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require('../../config/database.php');
include_once('../../model/Task.php');

$todo = new Task($connection);
$todo->id = isset($_GET['id']) ? $_GET['id'] : die();
$todo->getTaskDetail();
// $todolist_item = [
//     'id' => $todo->id,
//     'title' => $todo->title,
//     'isCompleted' => $todo->isCompleted,
//     'isEditing' => $todo->isEditing,
//     'isModalOpen' => $todo->isModalOpen,
//     'idDuedate' => $todo->idDuedate,
//     'dueDate' => $todo->dueDate
// ];
$todolist_item = [
    'id' => $todo->id,
    'title' => $todo->title,
    'description' => $todo->description,
    'project_id' => $todo->project_id,
    'section_id' => $todo->section_id,
    'priority' => $todo->priority,
    'parent_task_id' => $todo->parent_task_id,
    'status' => $todo->status,
    'created_at' => $todo->created_at,
    'edited_at' => $todo->edited_at,
    'dueDate' => $todo->dueDate
];
echo json_encode($todolist_item);
