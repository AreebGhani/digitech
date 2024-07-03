<?php

if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {
    exit;
}

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers");

include_once "../../Config/Database.php";
include_once "../../Models/Course.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Course Object
$courseObj = new Course($db);

// Get Raw Posted Data
$data = json_decode(file_get_contents("php://input"));

// If Data Found
if ($data) {

    $courseObj->course_id = $data->course_id;

    // Delete Course
    if ($courseObj->delete()) {
        echo json_encode(array(
            "status" => "ok",
            "message" => "Course Deleted",
        ));
    } else {
        echo json_encode(array(
            "status" => "error",
            "message" => "Course Not Deleted",
        ));
    }
}
