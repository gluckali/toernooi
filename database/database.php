<?php
class database{
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    // bij de construct leggen we de connectie aan met de database 
    public function __construct(){
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'toernooi';

    // hier wordt er bij de "try" de connectie gemaakt met de database 
    try{
        $dsn = "mysql:host=$this->host;dbname=$this->database";
        $this->conn =new PDO ($dsn, $this->username, $this->password);
        }catch (PDOException $e) {
            // hier wordt er een error gegeven als de connectie niet werkt
            die ("Unable to connect. Error: " . $e.getMessage());
        }
    }
    
    public function add($statement, $named_placeholder, $location){
        $stmt = $this->conn->prepare($statement);
        $stmt->execute($named_placeholder);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('location:'.$location);
        exit();
    } 
    public function select($statement, $named_placeholder){
        $stmt = $this->conn->prepare($statement);
        $stmt->execute($named_placeholder); //['uname'=>$username]
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function update_or_delete($statement, $named_placeholder, $location){
        $stmt = $this->conn->prepare($statement);
        $stmt->execute($named_placeholder);
        header('location:'.$location);
        exit();
    }
    public function registermedewerker($statement, $named_placeholder, $location){
        $stmt = $this->conn->prepare($statement);
        $stmt->execute($named_placeholder);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('location:'.$location);
        exit();
    }
}
?>