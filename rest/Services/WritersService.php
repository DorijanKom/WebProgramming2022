<?php

    require_once __DIR__-'/BaseService.php';
    require_once __DIR__.'/../DAO/WritersDAO.class.php';

    class WritersService extends BaseService {

        public function __construct()
        {
            parent::__construct(new WritersDAO());
        }
    }

?>