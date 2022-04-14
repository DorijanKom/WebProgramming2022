<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class UsersDAO extends BaseDAO{
        public function __construct()
        {
            parent::__construct("Users");
        }
}
?>