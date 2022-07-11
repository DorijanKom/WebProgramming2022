<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/PurchasesDAO.class.php';

    class PurchasesService extends BaseService {

        private $bookDAO;
        private $userDAO;

        public function __construct()
        {
            parent::__construct(new PurchaseDAO());
            $this->bookDAO = new BooksDAO();
            $this->userDAO = new UsersDAO();
        }

        public function getPurchaseAndBookAndUser(){
            return $this->dao->getPurchaseAndBookAndUser();
        }

        public function getPurchaseAndBookAndUserById($id){
            return $this->dao->getPurchaseAndBookAndUserById($id);
        }

        public function addPurchase($purchaseDescriptor){
            $book = $this->bookDAO->getByID($purchaseDescriptor['BookID']);
            $user = $this->userDAO->getUserByName($purchaseDescriptor['User_Name'],$purchaseDescriptor['User_Last_Name']);

            if($book['In_inventory'] < 0){
                return null;
            } else {
                date_default_timezone_set('Europe/Sarajevo');
                $purchaseDescriptor['Date_Of_Purchase'] = date("Y-m-d");
                $purchaseDescriptor['Time_Of_Purchase']= date("Y-m-d H:i:s");
                
                $purchase = $this->dao->add(["BookID"=>$book['id'],
                                            "Time_Of_Purchase"=>$purchaseDescriptor['Time_Of_Purchase'],
                                            "Date_Of_Purchase"=>$purchaseDescriptor['Date_Of_Purchase'],
                                            "Sold_By"=>$user['id']]);

                
                $newInventory = $book['In_inventory'] - 1;
                $this->bookDAO->update(['In_inventory'=>$newInventory],$book['id']);
                return $purchase;                            
            }
        }
    }

?>