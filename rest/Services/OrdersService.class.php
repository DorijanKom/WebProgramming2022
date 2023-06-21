<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/OrdersDAO.class.php';
    require_once __DIR__.'/../DAO/UsersDAO.class.php';
    require_once __DIR__.'/../DAO/BooksDAO.class.php';

    class OrdersService extends BaseService
    {
        private $bookDAO;
        private $userDAO;

        public function __construct()
        {
            parent::__construct(OrdersDAO::getInstance());
            $this->bookDAO = BooksDAO::getInstance();
            $this->userDAO = UsersDAO::getInstance();
        }

        public function getOrdersAndUsers()
        {
            return $this->dao->getOrdersAndUsers();
        }

        public function getOrderByID($id)
        {
            return $this->dao->getOrdersAndUsersByID($id);
        }

        public function addOrderWithUser($orderDescriptor)
        {
            $book = $this->bookDAO->getBookByName($orderDescriptor['book_name']);
            $user = $this->userDAO->getUserByName($orderDescriptor['User_Name'], $orderDescriptor['User_Last_Name']);

            if (!isset($book['id'])) {
                return null;
            } else {
                // Calculates the amount of books ordered times the book price
                $calcAmount = $orderDescriptor['Order_Amount'] * $book['Book_price'];

                // If date of delivery is left empty change its value to null
                if ($orderDescriptor['Date_of_Delivery']=='') {
                    $orderDescriptor['Date_of_Delivery']=null;
                }

                $order = $this->dao->add(['Order_Amount'=>$orderDescriptor['Order_Amount'],
                'book_name'=>$orderDescriptor['book_name'],
                'Order_price'=>$calcAmount,
                'Date_of_Order'=>$orderDescriptor['Date_of_Order'],
                'Date_of_Delivery'=>$orderDescriptor['Date_of_Delivery'],
                'ordered_by'=>$user['id']]);


                $newInventory = $orderDescriptor['Order_Amount'] + $book['In_inventory'];

                $this->bookDAO->update(['In_inventory'=>$newInventory], $book['id']);

                return $order;
            }
        }

        public function updateOrder($orderDescriptor, $id)
        {
            
            $book = $this->bookDAO->get_book_by_name($orderDescriptor['book_name']);
            $user = $this->userDAO->getUserByName($orderDescriptor['User_Name'], $orderDescriptor['User_Last_Name']);
            $oldOrder = $this->dao->getOrdersAndUsersByID($id);
            
            if (!isset($book['id'])) {
                return null;
            } else {
                $calcAmount = $orderDescriptor['Order_Amount'] * $book['Book_price'];

                // If date of delivery is left empty change its value to null
                if ($orderDescriptor['Date_of_Delivery']=='') {
                    $orderDescriptor['Date_of_Delivery']=null;
                }


                // If book entry matches the one in the Books table add the order
                $order = $this->dao->update(['Order_Amount'=>$orderDescriptor['Order_Amount'],
                'book_name'=>$orderDescriptor['book_name'],
                'Order_price'=>$calcAmount,
                'Date_of_Order'=>$orderDescriptor['Date_of_Order'],
                'Date_of_Delivery'=>$orderDescriptor['Date_of_Delivery'],
                'ordered_by'=>$user['id']], $id);


                $newInventory = $orderDescriptor['Order_Amount'] + ($book['In_inventory']-$oldOrder['Order_Amount']);

                $this->bookDAO->update(['In_inventory'=>$newInventory], $book['id']);

                return print_r("success");
            }
        }
    }
