<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/BooksAndWritersDAO.class.php';

    class BooksAndWritersService extends BaseService {
        public function __construct()
        {
            parent::__construct(new BooksAndWritersDAO);
        }
    }
?>