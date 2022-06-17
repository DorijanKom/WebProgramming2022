<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/PublisherDAO.class.php';

    class PublishersService extends BaseService {

        public function __construct()
        {
            parent::__construct(new PublisherDAO());
        }
    }

?>