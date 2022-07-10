<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class OrdersDAO extends BaseDAO{
        public function __construct()
        {
            parent::__construct("Orders");
        }

        public function getOrdersAndUsers(){
            $stm = "SELECT o.id, o.book_name, o.Order_Amount, o.Order_price, o.Date_of_Order, o.Date_of_Delivery 
                    FROM Orders o ";       
            $stm .= "ORDER BY o.id ASC";
            $result = $this->conn->prepare($stm);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getOrdersAndUsersByID($id){
            $stm = "SELECT o.id, o.book_name, o.Order_Amount, o.Order_price, o.Date_of_Order, o.Date_of_Delivery ";
            $stm .= "FROM Orders o ";
            $stm .= "WHERE o.id = :id";
            $result = $this->conn->prepare($stm);
            $result->execute(['id'=>$id]);
            return @reset($result->fetchAll(PDO::FETCH_ASSOC));
        }
}
?>