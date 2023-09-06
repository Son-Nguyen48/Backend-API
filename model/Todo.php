<?php
class Todo
{
    private $connection;

    // Todo properties 
    public $id;
    public $title;
    public $description;
    public $project_id;
    public $section_id;
    public $priority;
    public $parent_task_id;
    public $status;
    public $created_at;
    public $edited_at;
    public $dueDate;

    // connect to db 

    public function __construct($database)
    {
        $this->connection = $database;
    }

    // read data 

    public function getAllTask()
    {
        $query = "SELECT * FROM task ORDER BY id ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function getAllSection()
    {
        $query = "SELECT * FROM section ORDER BY id ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function getAllTaskInSection()
    {
        $query = "SELECT * FROM task WHERE NOT section_id='' ORDER BY id ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function getAllTaskNotInSection()
    {
        $query = "SELECT * FROM task WHERE NOT project_id='' ORDER BY id ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function getTaskDetail()
    {
        $query = "SELECT * FROM task WHERE id=?";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->project_id = $row['project_id'];
        $this->section_id = $row['section_id'];
        $this->priority = $row['priority'];
        $this->parent_task_id = $row['parent_task_id'];
        $this->status = $row['status'];
        $this->created_at = $row['created_at'];
        $this->edited_at = $row['edited_at'];
        $this->dueDate = $row['dueDate'];
    }
}
