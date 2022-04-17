<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/** 
 * Class for executing db functions
*/
class BaseDAO {
    
    protected $conn;
    private $table_name;
    
    /**
     * Constructor for BookstoreDAO
     */
    public function __construct($table_name)
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "4@ERbR2gSa6yLg";
        $schema = "Bookstore";
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }

    /**
     * Function for returning all of the elements from a table
     */
    public function getAll(){ 
      $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *  Function returns elements by ID
     */
    
    public function getByID($id){ 
      $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name." WHERE id = :id");
      $stmt->execute(['id' => $id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return reset($result);
    }

    /**
     * Function for inserting new data into a table
     * Made through string concatination
     */
    protected function exec_add($params){
      //INSERT INTO Users(User_Name, User_Last_Name, User_email, User_Role) 
      //VALUES (Nihad, Sevelija, nidjo@suveli.wtf, babo)
      
      $stmt = "INSERT INTO ".$this->table_name." (";
      foreach($params as $key=>$value){
      $stmt .= " ".$key.",";
      }
      $stmt = substr($stmt,0,-1);
      $stmt .= ") VALUES (";
      foreach($params as $key=>$value){
      $stmt .= " :".$key.",";
      }
      $stmt = substr($stmt,0,-1);
      $stmt .= ")";
      $this->conn->prepare($stmt)->execute($params);
      $params['id'] = $this->conn->lastInsertId();
      return $params;
    }

    /** 
     *  Function for deleting data from a table
    */
    public function delete($id){
      $stmt = $this->conn->prepare("DELETE FROM ".$this->table_name." WHERE id=:id");
      $stmt->bindParam(':id',$id);
      $stmt->execute();
    }

    /**
     *  Function for updating data in a table
     */
    protected function exec_update($params,$id){
      /** UPDATE table_name
        * SET column1=value, column2=value2,...
        * WHERE some_column=some_value
        * UPDATE $table SET (col1=val1,col2=val2,..) WHERE id=$id  
       */
      $stmt = "UPDATE ".$this->table_name." SET ";
      foreach($params as $key=>$value){
          $stmt .= " " .$key ." = :". $key .", ";
      }
      $stmt = substr($stmt,0,-2);
      $stmt .= " WHERE id=$id";
      $result = $this->conn->prepare($stmt);
      $result->execute($params);
    }

    /**
     *  Used for sending a query with its paramaters
     */
    protected function query($query, $params){
    $stmt = $this->conn->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *  Used for sending a query for unique entries in the database
    */
    protected function queryUnique($query, $params){
    $results = $this->query($query,$params);
    return reset($results);
  } 

    public function add($params){
      $this->exec_add($params);
    }

    public function update($params, $id){
      $this->exec_update($params, $id);
    }
}
?>