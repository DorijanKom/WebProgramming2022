<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/OrdersDAO.class.php';
    require_once __DIR__.'/../DAO/UsersDAO.class.php';
    require_once __DIR__.'/../DAO/BooksDAO.class.php';

    class OrdersService extends BaseService {

        public function __construct()
        {
            parent::__construct(new OrdersDAO());
            $this->userDAO = new UsersDAO();
            $this->bookDAO = new BooksDAO();
        }

        public function getOrdersAndUsers(){
            return $this->dao->getOrdersAndUsers();
        }

        public function addOrderWithUser($orderDescriptor){
            $user = $this->userDAO->getUserByName($orderDescriptor['User_Name'],$orderDescriptor['User_Last_Name']);
            $book = $this->bookDAO->get_book_by_name($orderDescriptor['Book_Name']);
            if(!isset($user['id'])){
                Flight::json(['message'=>'User does not exist!']);
            }
            if(!isset($book['id'])){
                Flight::json(["message"=>"Please create book entry!"]);
            }
            $calcAmount = $orderDescriptor['Order_Amount'] * $book['Book_price']; 

            $order = $this->dao->add(['Order_Amount'=>$orderDescriptor['Order_Amount'],
                            'BookID'=>$book['id'],
                            'Order_price'=>$calcAmount,
                            'Date_of_Order'=>$orderDescriptor['Date_of_Order'],
                            'Date_of_Delivery'=>$orderDescriptor['Date_of_Delivery'],
                            'User_ID'=>$user['id']]);
            
            

            $newInventory = $orderDescriptor['Order_Amount'] + $book['In_inventory'];
            
            $this->bookDAO->update(['In_inventory'=>$newInventory],$book['id']);
            
            return $order;
        }
    }

?>