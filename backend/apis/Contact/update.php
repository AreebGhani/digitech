<?php

if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
    exit;
}

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers");

include_once "../../Config/Database.php";
include_once "../../Models/Contact.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Contact Object
$contactObj = new Contact($db);

// Get Raw Posted Data
$data = json_decode(file_get_contents("php://input"));

// If Data Found
if ($data) {

    $contactObj->name = $data->name;
    $contactObj->email = $data->email;
    $contactObj->contact = $data->contact;
    $contactObj->subject = $data->subject;
    $contactObj->message = $data->message;
    $contactObj->date = date("Y-m-d , H:i:s");

    // Update Contact
    if ($contactObj->update()) {
        echo json_encode(array(
            "status" => "ok",
            "message" => "Contact Updated",
        ));
    } else {
        echo json_encode(array(
            "status" => "error",
            "message" => "Contact Not Updated",
        ));
    }
}
