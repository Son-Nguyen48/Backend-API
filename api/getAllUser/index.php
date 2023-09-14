<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');
require('../../config/database.php');
include_once('../../model/User.php');

$user = new User($connection);
$users = $user->getAllUser();

$num = $users->rowCount();
if ($num > 0) {
    // $todolist = [];
    $userlist['user'] = [];

    while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $userlist_item = [
            'id' => $id,
            'name' => $name,
            'role' => $role,
            'email' => $email,
            'password' => $password,
            'photo' => $photo
        ];
        array_push($userlist['user'], $userlist_item);
    }

    echo json_encode($userlist);
}
