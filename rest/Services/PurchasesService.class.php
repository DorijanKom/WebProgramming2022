<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/PurchasesDAO.class.php';

    class PurchasesService extends BaseService {

        public function __construct()
        {
            parent::__construct(new PurchaseDAO());
        }

        public function getPurchaseAndBookAndUser(){
            return $this->dao->getPurchaseAndBookAndUser();
        }

        public function getPurchaseAndBookAndUserById($id){
            return $this->dao->getPurchaseAndBookAndUserById($id);
        }
    }

?>