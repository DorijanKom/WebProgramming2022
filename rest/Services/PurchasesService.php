<?php

    require_once __DIR__-'/BaseService.php';
    require_once __DIR__.'/../DAO/PurchasesDAO.class.php';

    class PurchasesService extends BaseService {

        public function __construct()
        {
            parent::__construct(new PurchaseDAO());
        }
    }

?>