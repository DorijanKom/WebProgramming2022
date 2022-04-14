<?php

    require_once ('DAO/BaseDAO.class.php');

    class PurchaseDAO extends BaseDAO{
        
        public function __construct()
        {
            parent::__construct("Purchases");    
        }
    }
?>