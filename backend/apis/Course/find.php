<?php

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    exit;
}

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../Config/Database.php";
include_once "../../Models/Course.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Course Object
$courseObj = new Course($db);

// Get ID
$courseObj->course_id = isset($_GET['id']) ? $_GET["id"] : die();

// Get Course
$courseObj->find();

// Create Array
$contactArray = array(
    "course_id" => $courseObj->course_id,
    "name" => $courseObj->name,
    "education" => $courseObj->education,
    "email" => $courseObj->email,
    "contact" => $courseObj->contact,
    "course" => $courseObj->course,
    "date" => $courseObj->date,
);

// Turn to JSON
if ($courseObj->name !== null && $courseObj->email !== null && $courseObj->education !== null) {
    print_r(json_encode($contactArray));
} else {
    // No Course
    echo json_encode(array(
        "id" => $courseObj->course_id,
        "message" => "No Course Found",
    ));
}
