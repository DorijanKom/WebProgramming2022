<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/BooksDAO.class.php';
    require_once __DIR__.'/../DAO/WritersDAO.class.php';

    class BooksService extends BaseService {
        private $writerDao;
        public function __construct()
        {
            $this->writerDao = new WritersDAO();
            parent::__construct(new BooksDAO());
        }

        public function getBooksWithWriterNames(){
            return $this->dao->get_books_with_writer_names();
        }

        public function addBookAndWriter($bookDescriptor){
          $writer = $this->writerDao->getWriterByNames($bookDescriptor['Writer_Last_Name'], $bookDescriptor['Writer_Name']);
          // no writer in DB add it
          if (!isset($writer['id'])){
            $writer = $this->writerDao->add(['Writer_Name' => $bookDescriptor['Writer_Name'], 'Writer_Last_Name' => $bookDescriptor['Writer_Last_Name']]);
          }

          $book = $this->dao->add(['Book_Name' => $bookDescriptor['Book_Name'],
                           'Writer_ID' => $writer['id'],
                           'Date_of_Publishing' => $bookDescriptor['Date_of_Publishing'],
                           'Book_price' => $bookDescriptor['Book_price']]);
          return $book;
        }
    }

?>
