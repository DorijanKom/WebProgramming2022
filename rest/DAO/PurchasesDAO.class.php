<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class PurchaseDAO extends BaseDAO{
        
        public function __construct()
        {
            parent::__construct("Purchase");    
        }

        public function getPurchaseAndBookAndUserById($id){
            $stmt="SELECT p.id, b.Book_Name, p.Time_of_Purchase, p.Date_of_Purchase, u.User_Name, u.User_Last_Name ";
            $stmt.="FROM Purchase p ";
            $stmt.="JOIN Books b ON b.id = p.BookID ";
            $stmt.="JOIN Users u ON p.Sold_By = u.id";
            $stmt.="WHERE p.id = :id ";
            $result = $this->conn->prepare($stmt);
            $result->execute(['id'=>$id]);
            return @reset($result->fetchAll(PDO::FETCH_ASSOC));
        }

        public function getPurchaseAndBookAndUser(){
            $stmt="SELECT p.id, b.Book_Name, p.Time_of_Purchase, p.Date_of_Purchase, u.User_Name, u.User_Last_Name ";
            $stmt.="FROM Purchase p ";
            $stmt.="JOIN Books b ON b.id = p.BookID ";
            $stmt.="JOIN Users u ON p.Sold_By = u.id ";
            $stmt.="ORDER BY p.id ASC;";
            $result=$this->conn->prepare($stmt);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>