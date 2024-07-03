<?php

class Course
{
    // DB Stuff
    private $connection;
    private $table = "course";

    // Course Properties
    public $course_id;
    public $name;
    public $education;
    public $email;
    public $contact;
    public $course;
    public $date;

    // Connection with DB
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // Get Courses
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

    // Find Course
    public function find()
    {
        // Create Query
        $query = "SELECT * from $this->table WHERE course_id = ?";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->course_id);

        // Execute  Query
        $stmt->execute();

        // Fetching
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set Properties
        $this->name = $row["name"];
        $this->name = $row["education"];
        $this->email = $row["email"];
        $this->subject = $row["contact"];
        $this->message = $row["course"];
        $this->date = $row["date"];
    }

    // Create Course
    public function create()
    {
        // Create Query
        $query = "INSERT INTO $this->table SET name = :name, education = :education, email = :email, contact = :contact, course = :course, date = :date";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Clean Data
        $this->name = htmlspecialchars((strip_tags($this->name)));
        $this->education = htmlspecialchars((strip_tags($this->education)));
        $this->email = htmlspecialchars((strip_tags($this->email)));
        $this->contact = htmlspecialchars((strip_tags($this->contact)));
        $this->course = htmlspecialchars((strip_tags($this->course)));
        $this->date = htmlspecialchars((strip_tags($this->date)));

        // Bind Data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":education", $this->education);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":course", $this->course);
        $stmt->bindParam(":date", $this->date);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        }

        // Print Errors
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    // Update Course
    public function update()
    {
        // Update Query
        $query = "UPDATE $this->table SET name = :name, education = :education, email = :email, contact = :contact, course = :course, date = :date WHERE course_id = :course_id";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Clean Data
        $this->name = htmlspecialchars((strip_tags($this->name)));
        $this->education = htmlspecialchars((strip_tags($this->education)));
        $this->email = htmlspecialchars((strip_tags($this->email)));
        $this->contact = htmlspecialchars((strip_tags($this->contact)));
        $this->course = htmlspecialchars((strip_tags($this->course)));
        $this->date = htmlspecialchars((strip_tags($this->date)));

        // Bind Data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":education", $this->education);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":course", $this->course);
        $stmt->bindParam(":date", $this->date);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        }

        // Print Errors
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    // Delete Course
    public function delete()
    {
        // Delete Query
        $query = "DELETE FROM $this->table WHERE course_id = :course_id";

        // Prepare Statement
        $stmt = $this->connection->prepare($query);

        // Clean Data
        $this->course_id = htmlspecialchars((strip_tags($this->course_id)));

        // Bind Data
        $stmt->bindParam(":course_id", $this->course_id);

        // Execute Query
        if ($stmt->execute()) {
            return true;
        }

        // Print Errors
        printf("Error: %s. \n", $stmt->error);

        return false;
    }
}
