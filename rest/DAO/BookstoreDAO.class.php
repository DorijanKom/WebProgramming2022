<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/** 
 * Class for executing db functions
*/
class BookstoreDAO {
    
    private $conn;
    
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

    
    /**
     * Function for returning all of the elements from a table
     */
    public function getAll($table){ 
        $stmt=$this->conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByID($table,$id){ 
        $stmt=$this->conn->prepare("SELECT * FROM $table WHERE id=$id");
        $this->conn->prepare($stmt);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    /**
     * Function for inserting new data into a table
     */
    public function add($table,$params){
        //INSERT INTO Users(User_Name, User_Last_Name, User_email, User_Role) 
        //VALUES (Nihad, Sevelija, nidjo@suveli.wtf, babo)
        
        $stmt="INSERT INTO $table (";
        foreach($params as $key=>$value){
        $stmt.=" ".$key.",";
        }
        $stmt=substr($stmt,0,-1);
        $stmt.=") VALUES (";
        foreach($params as $key=>$value){
        $stmt.=" :".$key.",";
        }
        $stmt=substr($stmt,0,-1);
        $stmt.=")";
        $this->conn->prepare($stmt)->execute($params);
        
    }

    /** 
     *  Function for deleting data from a table
    */
    public function delete($table,$id){
        $stmt="DELETE FROM $table WHERE id=$id";
        $result=$this->conn->prepare($stmt);
        $result->execute();
    }

    /**
     *  Function for updating data in a table
     */
    public function update($table,$params,$id){
        /** UPDATE table_name
          * SET column1=value, column2=value2,...
          * WHERE some_column=some_value
          * UPDATE $table SET (col1=val1,col2=val2,..) WHERE id=$id  
         */
        $stmt="UPDATE $table SET ";
        foreach($params as $key=>$value){
            $stmt .= " " .$key ." = :". $key .", ";
        }
        $stmt=substr($stmt,0,-2);
        $stmt.=" WHERE id=$id";
        $result=$this->conn->prepare($stmt);
        $result->execute($params);
    }
}
?>