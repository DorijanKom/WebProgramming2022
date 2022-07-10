<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/OrdersDAO.class.php';
    require_once __DIR__.'/../DAO/UsersDAO.class.php';
    require_once __DIR__.'/../DAO/BooksDAO.class.php';

    class OrdersService extends BaseService {

        public function __construct()
        {
            parent::__construct(new OrdersDAO());
            $this->bookDAO = new BooksDAO();
        }

        public function getOrdersAndUsers(){
            return $this->dao->getOrdersAndUsers();
        }

        public function getOrderByID($id){
            return $this->dao->getOrdersAndUsersByID($id);
        }

        public function addOrderWithUser($orderDescriptor){


            $book = $this->bookDAO->get_book_by_name($orderDescriptor['book_name']);

            // Calculates the amount of books ordered times the book price
            $calcAmount = $orderDescriptor['Order_Amount'] * $book['Book_price']; 

            // If date of delivery is left empty change its value to null
            if($orderDescriptor['Date_of_Delivery']==''){
                $orderDescriptor['Date_of_Delivery']=null;
            }

            // If book entry matches the one in the Books table add the order
            if(isset($book)){
                $order = $this->dao->add(['Order_Amount'=>$orderDescriptor['Order_Amount'],
                'book_name'=>$orderDescriptor['book_name'],
                'Order_price'=>$calcAmount,
                'Date_of_Order'=>$orderDescriptor['Date_of_Order'],
                'Date_of_Delivery'=>$orderDescriptor['Date_of_Delivery']]);
            } else {
                throw new \Exception("Please create book entry before adding order!");
            }


            $newInventory = $orderDescriptor['Order_Amount'] + $book['In_inventory'];
            
            $this->bookDAO->update(['In_inventory'=>$newInventory],$book['id']);
            
            return $order;
        }

        public function updateOrder($orderDescriptor,$id){
            $book = $this->bookDAO->get_book_by_name($orderDescriptor['book_name']);
            $oldOrder = $this->dao->getOrdersAndUsersByID($id);

            $calcAmount = $orderDescriptor['Order_Amount'] * $book['Book_price'];

            // If date of delivery is left empty change its value to null
            if($orderDescriptor['Date_of_Delivery']==''){
                $orderDescriptor['Date_of_Delivery']=null;
            }


            // If book entry matches the one in the Books table add the order
                $order = $this->dao->update(['Order_Amount'=>$orderDescriptor['Order_Amount'],
                'book_name'=>$orderDescriptor['book_name'],
                'Order_price'=>$calcAmount,
                'Date_of_Order'=>$orderDescriptor['Date_of_Order'],
                'Date_of_Delivery'=>$orderDescriptor['Date_of_Delivery']],$id);

            
            $newInventory = $orderDescriptor['Order_Amount'] + ($book['In_inventory']-$oldOrder['Order_Amount']);
            
            $this->bookDAO->update(['In_inventory'=>$newInventory],$book['id']);
            
            return $order;
        }
    }

?>