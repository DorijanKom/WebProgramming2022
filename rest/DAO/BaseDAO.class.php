<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/** 
 * Class for executing db functions
*/
class BaseDAO {
    
    protected $conn;
    
    /**
     * Constructor for BookstoreDAO
     */
    public function __construct()
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "4@ERbR2gSa6yLg";
        $schema = "Bookstore";
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }

    //TEST
    public function query($query){
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function queryUnique($query, $params){
    $results= $this->conn->prepare($query);
    $results->execute($params);
    return $results->fetchAll(PDO::FETCH_ASSOC);
  } 
}
?>