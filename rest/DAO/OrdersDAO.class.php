<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class OrdersDAO extends BaseDAO{
        public function __construct()
        {
            parent::__construct("Orders");
        }

        public function getOrdersAndUsers(){
            $stm = "SELECT o.id, o.Order_Amount , b.Book_Name, o.Order_price, o.Date_of_Order, o.Date_of_Delivery, u.User_Name, u.User_Last_Name ";
            $stm .= "FROM Orders o ";
            $stm .= "JOIN Books b ON b.id = o.BookID ";
            $stm .= "JOIN Users u ON o.User_ID  = u.id ";
            $stm .= "ORDER BY o.id ASC";
            $result = $this->conn->prepare($stm);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getOrdersAndUsersByID($id){
            $stm = "SELECT o.id, o.Order_Amount , b.Book_Name, o.Order_price, o.Date_of_Order, o.Date_of_Delivery, u.User_Name, u.User_Last_Name ";
            $stm .= "FROM Orders o ";
            $stm .= "JOIN Books b ON b.id = o.BookID ";
            $stm .= "JOIN Users u ON o.User_ID  = u.id ";
            $stm .= "WHERE o.id = :id";
            $stm .= "ORDER BY o.id ASC";
            $result = $this->conn->prepare($stm);
            $result->execute(["id"=>$id]);
            return @reset($result->fetchAll(PDO::FETCH_ASSOC));
        }
}
?>