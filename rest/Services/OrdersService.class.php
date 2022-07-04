<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/OrdersDAO.class.php';

    class OrdersService extends BaseService {

        public function __construct()
        {
            parent::__construct(new OrdersDAO());
        }

        public function getOrdersAndUsers(){
            return $this->dao->getOrdersAndUsers();
        }
    }

?>