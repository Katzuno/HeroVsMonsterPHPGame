<?php

class DatabaseController
{
    private $serverIp;
    private $database;
    private $username;
    private $password;

    private $conn;

    function __construct($serverIp, $database, $username, $password)
    {
        $this->serverIp = $serverIp;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;

    }

    public function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->serverIp;dbname=$this->database", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if ( getenv('DEBUG_MODE') == 'true' ) {
                echo "Connected successfully";
            }
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function executeQuery($sql)
    {
        try
        {
            $this->conn->exec($sql);
            if ( getenv('DEBUG_MODE') == 'true' ) {
                echo "<br/>The following query was executed succesfully<br/>";
                echo $sql;
            }
        }
        catch (PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function select($sql)
    {
        try {
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetchAll();
            return $result;
        }
        catch (PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
            return 0; // 0 MEANS ERROR
        }
    }

}