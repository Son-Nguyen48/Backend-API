<?php
class Task
{
    private $connection;

    // Task properties 
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
        // $offset_value = 2;
        // $query = "SELECT * FROM task  ORDER BY id ASC LIMIT 2 OFFSET " . $offset_value;
        $query = "SELECT * FROM task  ORDER BY id ASC";
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

    public function getAllTaskProject()
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

    public function addTaskInProject(array $formData, array $data)
    {
        $query = "INSERT INTO task (title, description, project_id)
        VALUES (?, ?, ?) ";
        $statement = $this->connection->prepare($query);
        $this->title = $formData['title'];
        $this->description = $formData['description'];
        $this->project_id = $formData['project_id'];
        $statement->bindParam(3, $this->project_id);
        $statement->bindParam(1, $this->title);
        $statement->bindParam(2, $this->description);
        if ($statement->execute()) {
            $lastInsertId = $this->connection->lastInsertId();
            $data['project_id'] = $lastInsertId;
            echo json_encode($data);
        } else {
            echo "Error!";
        }
    }
    public function addTaskInSection(array $formData, array $data)
    {
        $query = "INSERT INTO task (title, description, section_id)
        VALUES (?, ?,  ?) ";
        $statement = $this->connection->prepare($query);
        $this->title = $formData['title'];
        $this->description = $formData['description'];
        $this->section_id = $formData['section_id'];
        $statement->bindParam(1, $this->title);
        $statement->bindParam(2, $this->description);
        $statement->bindParam(3, $this->section_id);
        if ($statement->execute()) {
            $lastInsertId = $this->connection->lastInsertId();
            $data['project_id'] = $lastInsertId;
            echo json_encode($data);
        } else {
            echo "Error!";
        }
    }

    public function setPriority(int $priority, int $id)
    {
        $query = "UPDATE task SET priority = :priority WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $query = "SELECT * FROM task WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode([
            'id' => $id,
            'priority' => $priority,
            'result' => $result
        ]);
    }
}
