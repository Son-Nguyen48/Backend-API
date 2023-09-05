<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require('../../config/database.php');
include_once('../../model/Todo.php');

$todo = new Todo($connection);
$todos = $todo->getAllTask();

$num = $todos->rowCount();
if ($num > 0) {
    $todolist = [];
    $todolist['taskList'] = [];

    while ($row = $todos->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $todolist_item = [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'project_id' => $project_id,
            'section_id' => $section_id,
            'priority' => $priority,
            'parent_task_id' => $parent_task_id,
            'status' => $status,
            'created_at' => $created_at,
            'edited_at' => $edited_at,
            'dueDate' => $dueDate
        ];
        array_push($todolist['taskList'], $todolist_item);
    }

    echo json_encode($todolist);
}
