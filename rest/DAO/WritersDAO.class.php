<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class WritersDAO extends BaseDAO {
        public function __construct()
        {
            parent::__construct("Writers");
        }
}
?>