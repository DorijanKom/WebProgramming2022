<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../Config.class.php';

/**
 * Class for executing db functions
*/
class BaseDAO
{

    protected $conn;
    private static $pdoInstance = null;
    private $tableName;
  
    //CONSTRUCTOR
    public function __construct($tableName){
      $this->tableName=$tableName;
      $this->conn = self::getPDO();
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  
    private static function getPDO() {
      if (!isset(self::$pdoInstance)) {
        $servername = Config::DB_HOST();
        $username = Config::DB_USERNAME();
        $password = Config::DB_PASSWORD();
        $schema = Config::DB_SCHEME();
        $port = Config::DB_PORT();
        self::$pdoInstance = new PDO("mysql:host=$servername;port=$port;dbname=$schema", $username, $password);
      }
      return self::$pdoInstance;
    }

    /**
     * Function for returning all of the elements from a table
     */
    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->tableName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *  Function returns elements by ID
     */

    public function getByID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->tableName." WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
    }

    /**
     * Function for inserting new data into a table
     * Made through string concatination
     */
    protected function exec_add($params)
    {
        //INSERT INTO Users(User_Name, User_Last_Name, User_email, User_Role)
        //VALUES (Nihad, Sevelija, nidjo@suveli.wtf, babo)

        $stmt = "INSERT INTO ".$this->tableName." (";
        foreach ($params as $key=>$value) {
            $stmt .= " ".$key.",";
        }
        $stmt = substr($stmt, 0, -1);
        $stmt .= ") VALUES (";
        foreach ($params as $key=>$value) {
            $stmt .= " :".$key.",";
        }
        $stmt = substr($stmt, 0, -1);
        $stmt .= ")";
        $this->conn->prepare($stmt)->execute($params);
        $params['id'] = $this->conn->lastInsertId();
        return $params;
    }

    /**
     *  Function for deleting data from a table
    */
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM ".$this->tableName." WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     *  Function for updating data in a table
     */
    protected function execUpdate($params, $id)
    {
        /** UPDATE table_name
          * SET column1=value, column2=value2,...
          * WHERE some_column=some_value
          * UPDATE $table SET (col1=val1,col2=val2,..) WHERE id=$id
         */
        $stmt = "UPDATE ".$this->tableName." SET ";
        foreach ($params as $key=>$value) {
            $stmt .= " " .$key ." = :". $key .", ";
        }
        $stmt = substr($stmt, 0, -2);
        $stmt .= " WHERE id=$id";
        $result = $this->conn->prepare($stmt);
        $result->execute($params);
    }

    /**
     *  Used for sending a query with its paramaters
     */
    protected function query($query, $params)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *  Used for sending a query for unique entries in the database
    */
    protected function queryUnique($query, $params)
    {
        $results = $this->query($query, $params);
        return reset($results);
    }

    public function add($params)
    {
        return $this->exec_add($params);
    }

    public function update($params, $id)
    {
        $this->execUpdate($params, $id);
    }
}
