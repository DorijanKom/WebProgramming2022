<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class OrdersDAO extends BaseDAO
    {
        private static $instance = null;
        
        public function __construct()
        {
            parent::__construct("Orders");
        }
        
        
        public static function getInstance() {
            if (!isset(self::$instance)) {
              self::$instance = new self();
            }
            return self::$instance;
        }
        
          public function getOrdersAndUsers()
        {
            $stm = "SELECT o.id, o.book_name, o.Order_Amount, o.Order_price, o.Date_of_Order, o.Date_of_Delivery, u.User_Name, u.User_Last_Name 
                    FROM Orders o 
                    JOIN Users u ON u.id = o.ordered_by ";
            $stm .= "ORDER BY o.id ASC";
            $result = $this->conn->prepare($stm);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getOrdersAndUsersByID($id)
        {
            $stm = "SELECT o.id, o.book_name, o.Order_Amount, o.Order_price, o.Date_of_Order, o.Date_of_Delivery, u.User_Name, u.User_Last_Name ";
            $stm .= "FROM Orders o ";
            $stm .= "JOIN Users u ON u.id = o.ordered_by ";
            $stm .= "WHERE o.id = :id";
            $result = $this->conn->prepare($stm);
            $result->execute(['id'=>$id]);
            return @reset($result->fetchAll(PDO::FETCH_ASSOC));
        }
    }
