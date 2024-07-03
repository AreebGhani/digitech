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

// Contact Query
$result = $contactObj->read();

// Get number of rows
$num = $result->rowCount();

// Check if any contact
if ($num > 0) {
    // Contacts Array
    $contactArray = array();
    $contactArray["data"] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $contact = array(
            "contact_id" => $id,
            "name" => $name,
            "email" => $email,
            "contact" => $contact,
            "subject" => $subject,
            "message" => $message,
            "date" => $date,
        );

        // Push to "data"
        array_push($contactArray["data"], $contact);
    }

    // Turn to JSON
    echo json_encode($contactArray);
} else {
    // No Contact
    echo json_encode(array(
        "message" => "No Contact Found"
    ));
}
