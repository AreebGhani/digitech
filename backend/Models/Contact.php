<?php

class Contact
{
    // DB Stuff
    private $connection;
    private $table = "contact";

    // Contact Properties
    public $contact_id;
    public $name;
    public $email;
    public $contact;
    public $subject;
    public $message;
    public $date;

    // Connection with DB
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // Get Contacts
    public function read()
    {
        // Create Query
        $query = "SELECT * from $this->table";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Execute  Query
        $stmt->execute();

        return $stmt;
    }

    // Find Contact
    public function find()
    {
        // Create Query
        $query = "SELECT * from $this->table WHERE contact_id = ?";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->contact_id);

        // Execute  Query
        $stmt->execute();

        // Fetching
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set Properties
        $this->name = $row["name"];
        $this->email = $row["email"];
        $this->contact = $row["contact"];
        $this->subject = $row["subject"];
        $this->message = $row["message"];
        $this->date = $row["date"];
    }

    // Create Contact
    public function create()
    {
        // Create Query
        $query = "INSERT INTO $this->table SET name = :name, email = :email, contact = :contact, subject = :subject, message = :message, date = :date";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Clean Data
        $this->name = htmlspecialchars((strip_tags($this->name)));
        $this->email = htmlspecialchars((strip_tags($this->email)));
        $this->contact = htmlspecialchars((strip_tags($this->contact)));
        $this->subject = htmlspecialchars((strip_tags($this->subject)));
        $this->message = htmlspecialchars((strip_tags($this->message)));
        $this->date = htmlspecialchars((strip_tags($this->date)));

        // Bind Data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":subject", $this->subject);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":date", $this->date);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        }

        // Print Errors
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    // Update Contact
    public function update()
    {
        // Update Query
        $query = "UPDATE $this->table SET name = :name, email = :email, contact = :contact, subject = :subject, message = :message, date = :date WHERE contact_id = :contact_id";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Clean Data
        $this->contact_id = htmlspecialchars((strip_tags($this->contact_id)));
        $this->name = htmlspecialchars((strip_tags($this->name)));
        $this->email = htmlspecialchars((strip_tags($this->email)));
        $this->contact = htmlspecialchars((strip_tags($this->contact)));
        $this->subject = htmlspecialchars((strip_tags($this->subject)));
        $this->message = htmlspecialchars((strip_tags($this->message)));
        $this->date = htmlspecialchars((strip_tags($this->date)));

        // Bind Data
        $stmt->bindParam(":contact_id", $this->contact_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":subject", $this->subject);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":date", $this->date);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        }

        // Print Errors
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    // Delete Contact
    public function delete()
    {
        // Delete Query
        $query = "DELETE FROM $this->table WHERE contact_id = :contact_id";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Clean Data
        $this->contact_id = htmlspecialchars((strip_tags($this->contact_id)));

        // Bind Data
        $stmt->bindParam(":contact_id", $this->contact_id);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        }

        // Print Errors
        printf("Error: %s. \n", $stmt->error);

        return false;
    }
}
