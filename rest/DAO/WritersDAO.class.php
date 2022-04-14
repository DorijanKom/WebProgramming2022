<?php

    require_once __DIR__.'DAO/BaseDAO.class.php';

    class WritersDAO extends BaseDAO {
        public function __construct()
        {
            parent::__construct("Writers");
        }
}
?>