<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "newtodoist";
$connection = null;
// $servername = "localhost";
// $username = "id21224018_databaseusername";
// $password = "19124321My@";
// $database = "id21224018_todoistdatabase";
// $connection = null;


try {
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $connection = null;
}