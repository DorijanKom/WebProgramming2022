<?php

    require_once __DIR__-'/BaseService.php';
    require_once __DIR__.'/../DAO/BooksDAO.class.php';

    class BooksService extends BaseService {

        public function __construct()
        {
            parent::__construct(new BooksDAO());
        }

        public function getBooksWithWriterNames(){
            return $this->dao->get_books_with_writer_names();
        }
    }

?>