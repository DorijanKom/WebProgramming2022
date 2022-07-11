<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/BooksDAO.class.php';
    require_once __DIR__.'/../DAO/WritersDAO.class.php';
    require_once __DIR__.'/../DAO/BooksAndWritersDAO.class.php';
    require_once __DIR__.'/../DAO/PublisherDAO.class.php';

    class BooksService extends BaseService {
        private $writerDao;
        private $publisherDAO;
        private $booksAndWritersDAO;
        public function __construct()
        {
            $this->writerDao = new WritersDAO();
            $this->publisherDAO = new PublisherDAO();
            $this->booksAndWritersDAO = new BooksAndWritersDAO();
            parent::__construct(new BooksDAO());
        }

        public function getBooksWithWriterNames(){
            return $this->dao->get_books_with_writer_names();
        }

        public function getByIDWithWriterNames($id){
          return $this->dao->get_by_id_with_writer_names($id);
        }

        public function searchBook($name){
          return $this->dao->search_book($name);
        }

        public function searchWriter($name,$lastName){
          return $this->dao->search_writer($name,$lastName);
        }

        public function findBook($book){
          return $this->dao->find_book($book);
        }


        public function addBookAndWriter($bookDescriptor){


              if($this->findBook($bookDescriptor)['0']['found']!=0){
                return null;
              } else {
                $writer = $this->writerDao->getWriterByNames($bookDescriptor['Writer_Last_Name'], $bookDescriptor['Writer_Name']);
                $publisher = $this->publisherDAO->getByPublisherName($bookDescriptor['name']);
                // no writer in DB add it
                if (!isset($writer['id'])){
                  $writer = $this->writerDao->add(['Writer_Name' => $bookDescriptor['Writer_Name'], 'Writer_Last_Name' => $bookDescriptor['Writer_Last_Name']]);
                }
  
                if (!isset($publisher['id'])){
                  $publisher = $this->publisherDAO->add(['name' => $bookDescriptor['name']]);
                }
  
  
                $addedBook = $this->dao->add(['Book_Name' => $bookDescriptor['Book_Name'],
                                'Publisher' => $publisher['id'],
                                'Year_of_publishing' => $bookDescriptor['Year_of_publishing'],
                                'Book_price' => $bookDescriptor['Book_price'],
                                'In_inventory' => $bookDescriptor['In_inventory']]);

                
                $book = $this->dao->get_by_id_with_writer_names($addedBook['id']); 
                $baw = $this->booksAndWritersDAO->add(['bookid'=>$book['id'],'writerid'=>$writer['id']]);

  
                return $book;
              }
        }

        public function updateBookAndWriter($bookDescriptor,$id){
              
          if($this->findBook($bookDescriptor)['0']['found']!=0){
            return null;
          } else {
            $writer = $this->writerDao->getWriterByNames($bookDescriptor['Writer_Last_Name'], $bookDescriptor['Writer_Name']);
            $publisher = $this->publisherDAO->getByPublisherName($bookDescriptor['name']);
            
            // no writer in DB add it
            if (!isset($writer['id'])){
              $writer = $this->writerDao->add(['Writer_Name' => $bookDescriptor['Writer_Name'], 'Writer_Last_Name' => $bookDescriptor['Writer_Last_Name']]);
            }
            // no publisher in DB add it
            if (!isset($publisher['id'])){
              $publisher = $this->publisherDAO->add(['name' => $bookDescriptor['name']]);
            }
            
            $this->dao->update(['Book_Name' => $bookDescriptor['Book_Name'],
                                      'Publisher' => $publisher['id'],
                                      'Year_of_publishing' => $bookDescriptor['Year_of_publishing'],
                                      'Book_price' => $bookDescriptor['Book_price'],
                                      'In_inventory' => $bookDescriptor['In_inventory']], $id);
                                      
            
            $book = $this->dao->get_by_id_with_writer_names($id);

            $baw = $this->booksAndWritersDAO->getBaW($book['id']);

            $this->booksAndWritersDAO->update(['bookid'=>$book['id'],'writerid'=>$writer['id']],$baw['id']);
            
            return $book;
          }
        }
    }

?>
