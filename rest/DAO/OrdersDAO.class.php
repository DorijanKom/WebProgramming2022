<?php

    require_once ('DAO/BaseDAO.class.php');

    class OrdersDAO extends BaseDAO{
    /**
     * Function for returning all of the elements from a table
     */
    public function getAll(){ 
        $stmt=$this->conn->prepare("SELECT * FROM Orders");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *  Function returns elements by ID
     */
    
    public function getByID($id){ 
        $stmt=$this->conn->prepare("SELECT * FROM Orders WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        return @reset($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    
    /**
     * Function for inserting new data into a table
     * Made through string concatination
     */
    public function add($params){
        //INSERT INTO Users(User_Name, User_Last_Name, User_email, User_Role) 
        //VALUES (Nihad, Sevelija, nidjo@suveli.wtf, babo)
        
        $stmt="INSERT INTO Orders (";
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
    public function delete($id){
        $stmt="DELETE FROM Orders WHERE id=$id";
        $result=$this->conn->prepare($stmt);
        $result->execute();
    }

    /**
     *  Function for updating data in a table
     */
    public function update($params,$id){
        /** UPDATE table_name
          * SET column1=value, column2=value2,...
          * WHERE some_column=some_value
          * UPDATE $table SET (col1=val1,col2=val2,..) WHERE id=$id  
         */
        $stmt="UPDATE Orders SET ";
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