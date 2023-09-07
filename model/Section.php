<?php
class Section
{
    private $connection;

    // Task properties 
    public $id;
    public $title;
    public $project_id;

    // connect to db 

    public function __construct($database)
    {
        $this->connection = $database;
    }

    // read data 

    public function getAllSection()
    {
        $query = "SELECT * FROM section ORDER BY id ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }



    public function getSectionDetail()
    {
        $query = "SELECT * FROM section WHERE id=?";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->project_id = $row['project_id'];
    }
}
