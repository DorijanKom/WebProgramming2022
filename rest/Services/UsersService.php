<?php

    require_once __DIR__-'/BaseService.php';
    require_once __DIR__.'/../DAO/UsersDAO.class.php';

    class UsersService extends BaseService {

        public function __construct()
        {
            parent::__construct(new UsersDAO());
        }
    }

?>