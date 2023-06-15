<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class PublisherDAO extends BaseDAO
    {
        private static $instance = null;
        
        public function __construct()
        {
            parent::__construct("Publishers");
        }

        public static function getInstance() {
            if (!isset(self::$instance)) {
              self::$instance = new self();
            }
            return self::$instance;
        }

        public function getByPublisherName($name)
        {
            return $this->queryUnique("SELECT *
            FROM Publishers
            WHERE name = :name", ['name'=>$name]);
        }
    }
