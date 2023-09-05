<?php
class Todo
{
    private $connection;

    // Todo properties 

    public $id;
    public $isEditing;
    public $isCompleted;
    public $isModalOpen;
    public $title;
    public $idDuedate;
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

    public function getTaskDetail()
    {
        $query = "SELECT * FROM todos WHERE id=?";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->isCompleted = $row['isCompleted'];
        $this->isEditing = $row['isEditing'];
        $this->isModalOpen = $row['isModalOpen'];
        $this->idDuedate = $row['idDuedate'];
        $this->dueDate = $row['dueDate'];
    }
}
