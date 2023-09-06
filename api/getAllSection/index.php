<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require('../../config/database.php');
include_once('../../model/Section.php');

$section = new Section($connection);
$sections = $section->getAllSection();

$num = $sections->rowCount();
if ($num > 0) {
    // $todolist = [];
    $sectionList['sectionList'] = [];

    while ($row = $sections->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $sectionList_item = [
            'id' => $id,
            'title' => $title,
            'project_id' => $project_id,
        ];
        array_push($sectionList['sectionList'], $sectionList_item);
    }

    echo json_encode($sectionList);
}
