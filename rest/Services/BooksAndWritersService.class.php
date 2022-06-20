<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/BooksAndWritersDAO.class.php';

    class BooksAndWritersService extends BaseService {
        public function __construct()
        {
            parent::__construct(new BooksAndWritersDAO);
        }

        public function deleteBook($bookid){
            return $this->dao->deleteBook($bookid);
        }

        public function deleteWriter($writerid){
            return $this->dao->deleteWriter($writerid);
        }

        public function getBaW($id){
            return $this->dao->getBaW($id);
        }
    }
?>