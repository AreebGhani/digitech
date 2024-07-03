<?php

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    exit;
}

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../Config/Database.php";
include_once "../../Models/Contact.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Contact Object
$contactObj = new Contact($db);

// Get ID
$contactObj->contact_id = isset($_GET['id']) ? $_GET["id"] : die();

// Get Contact
$contactObj->find();

// Create Array
$contactArray = array(
    "contact_id" => $contactObj->contact_id,
    "name" => $contactObj->name,
    "email" => $contactObj->email,
    "contact" => $contactObj->contact,
    "subject" => $contactObj->subject,
    "message" => $contactObj->message,
    "date" => $contactObj->date,
);

// Turn to JSON
if ($contactObj->name !== null && $contactObj->email !== null && $contactObj->contact !== null && $contactObj->subject !== null) {
    print_r(json_encode($contactArray));
} else {
    // No Contact
    echo json_encode(array(
        "id" => $contactObj->contact_id,
        "message" => "No Contact Found",
    ));
}
