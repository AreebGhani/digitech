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

// Course Query
$result = $courseObj->read();

// Get number of rows
$num = $result->rowCount();

// Check if any contact
if ($num > 0) {
    // Courses Array
    $courseArray = array();
    $courseArray["data"] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $course = array(
            "course_id" => $id,
            "name" => $name,
            "education" => $education,
            "email" => $email,
            "contact" => $contact,
            "course" => $course,
            "date" => $date,
        );

        // Push to "data"
        array_push($courseArray["data"], $course);
    }

    // Turn to JSON
    echo json_encode($courseArray);
} else {
    // No Course
    echo json_encode(array(
        "message" => "No Course Found"
    ));
}
