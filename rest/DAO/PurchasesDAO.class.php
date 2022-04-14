<?php

    require_once __DIR__.'DAO/BaseDAO.class.php';

    class PurchaseDAO extends BaseDAO{
        
        public function __construct()
        {
            parent::__construct("Purchases");    
        }
    }
?>