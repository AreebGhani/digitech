<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit;
}

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
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

    $courseObj->name = $data->name;
    $courseObj->education = $data->education;
    $courseObj->email = $data->email;
    $courseObj->contact = $data->contact;
    $courseObj->course = $data->course;
    $courseObj->date = date("Y-m-d , H:i:s");

    // Create Course
    if ($courseObj->create()) {
        echo json_encode(array(
            "status" => "ok",
            "message" => "Course Created",
        ));
    } else {
        echo json_encode(array(
            "status" => "error",
            "message" => "Course Not Created",
        ));
    }
}
