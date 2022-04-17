<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class PurchaseDAO extends BaseDAO{
        
        public function __construct()
        {
            parent::__construct("Purchase");    
        }
    }
?>