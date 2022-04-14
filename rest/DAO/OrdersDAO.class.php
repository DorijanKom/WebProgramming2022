<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class OrdersDAO extends BaseDAO{
        public function __construct()
        {
            parent::__construct("Orders");
        }
}
?>