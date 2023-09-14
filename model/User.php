<?php
class User
{
    private $connection;

    // Task properties 
    public $id;
    public $name;
    public $role;
    public $email;
    public $password;
    public $photo;

    // connect to db 

    public function __construct($database)
    {
        $this->connection = $database;
    }

    // read data 
    public function getAllUser()
    {
        $query = "SELECT * FROM user WHERE 1";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function register(array $formData)
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':email', $formData['email']);
        $statement->execute();
        if (!$statement->rowCount()) {
            $query = "INSERT INTO user (email, password, role)
            VALUES (?, ?, ?) ";
            $statement = $this->connection->prepare($query);
            $this->email = $formData['email'];
            $this->password = md5($formData['password']);
            $this->role = 0;
            $statement->bindParam(1, $this->email);
            $statement->bindParam(2, $this->password);
            $statement->bindParam(3, $this->role);
            if ($statement->execute()) {
                $lastInsertId = $this->connection->lastInsertId();
                $query = "SELECT * FROM user WHERE id = :id";
                $statement = $this->connection->prepare($query);
                $statement->bindParam(':id', $lastInsertId);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                echo json_encode([
                    'result' => $result
                ]);
            } else {
                echo "Error!";
            }
        } else {
            echo json_encode([
                'success' => "FALSE",
                'message' => "Email existed!"
            ]);
        }
    }

    public function login($formData)
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':email', $formData['email']);
        $statement->execute();
        if ($statement->rowCount()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $hashPassword = md5($formData['password']);
            if ($hashPassword === $result['password']) {
                echo json_encode([
                    'success' => "TRUE",
                    'message' => "Login successful!",
                    'result' => $result
                ]);
            } else echo  json_encode([
                'success' => "FALSE",
                'message' => "Incorrect email or password!",
                'result' => $result
            ]);
        } else echo  json_encode([
            'success' => "FALSE",
            'message' => "Incorrect email or password!"
        ]);
    }
}
