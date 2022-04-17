<?php

    require_once __DIR__-'/BaseService.php';
    require_once __DIR__.'/../DAO/OredersDAO.class.php';

    class OrdersService extends BaseService {

        public function __construct()
        {
            parent::__construct(new OrdersDAO());
        }
    }

?>