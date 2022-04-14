<?php

    require_once ('DAO/BaseDAO.class.php');

    class UsersDAO extends BaseDAO{
        public function __construct()
        {
            parent::__construct("Users");
        }
}
?>