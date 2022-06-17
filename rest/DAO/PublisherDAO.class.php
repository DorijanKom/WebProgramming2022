<?php
    require_once __DIR__.'/BaseDAO.class.php';

    class PublisherDAO extends BaseDAO{
        public function __construct()
        {
            parent::__construct("Publishers");   
        }

        public function getByPublisherName($name){
            return $this->queryUnique("SELECT *
            FROM Publishers
            WHERE name = :name",['name'=>$name]);
        }
    }
?>