<?php

    require_once __DIR__.'/BaseService.class.php';
    require_once __DIR__.'/../DAO/BooksDAO.class.php';
    require_once __DIR__.'/../DAO/WritersDAO.class.php';
    require_once __DIR__.'/../DAO/BooksAndWritersDAO.class.php';
    require_once __DIR__.'/../DAO/PublisherDAO.class.php';

    class BooksService extends BaseService
    {
        private $writerDao;
        private $publisherDAO;
        private $booksAndWritersDAO;
        public function __construct()
        {
            $this->writerDao = WritersDAO::getInstance();
            $this->publisherDAO = PublisherDAO::getInstance();
            $this->booksAndWritersDAO = BooksAndWritersDAO::getInstance();
            parent::__construct(BooksDAO::getInstance());
        }

        public function getBooksWithWriterNames()
        {
            return $this->dao->getBooksWithWriterNames();
        }

        public function getByIDWithWriterNames($id)
        {
            return $this->dao->getByIdWithWriterNames($id);
        }

        public function searchBook($name)
        {
            return $this->dao->searchBook($name);
        }

        public function findBook($book)
        {
            return $this->dao->findBook($book);
        }


        public function addBookAndWriter($bookDescriptor)
        {
            if ($this->findBook($bookDescriptor)['0']['found']!=0) {
                return null;
            } else {
                $writer = $this->writerDao->getWriterByNames($bookDescriptor['Writer_Last_Name'], $bookDescriptor['Writer_Name']);
                $publisher = $this->publisherDAO->getByPublisherName($bookDescriptor['name']);
                // no writer in DB add it
                if (!isset($writer['id'])) {
                    $writer = $this->writerDao->add(['Writer_Name' => $bookDescriptor['Writer_Name'], 'Writer_Last_Name' => $bookDescriptor['Writer_Last_Name']]);
                }

                if (!isset($publisher['id'])) {
                    $publisher = $this->publisherDAO->add(['name' => $bookDescriptor['name']]);
                }


                $addedBook = $this->dao->add(['Book_Name' => $bookDescriptor['Book_Name'],
                                'Publisher' => $publisher['id'],
                                'Year_of_publishing' => $bookDescriptor['Year_of_publishing'],
                                'Book_price' => $bookDescriptor['Book_price'],
                                'In_inventory' => $bookDescriptor['In_inventory']]);

                $book = $this->getByIDWithWriterNames($addedBook['id']);
                $baw = $this->booksAndWritersDAO->add(['bookid'=>$book['id'],'writerid'=>$writer['id']]);


                return $book;
            }
        }

        public function updateBookAndWriter($bookDescriptor, $id)
        {
            if ($this->findBook($bookDescriptor)['0']['found']!=0) {
                return null;
            } else {
                $writer = $this->writerDao->getWriterByNames($bookDescriptor['Writer_Last_Name'], $bookDescriptor['Writer_Name']);
                $publisher = $this->publisherDAO->getByPublisherName($bookDescriptor['name']);

                // no writer in DB add it
                if (!isset($writer['id'])) {
                    $writer = $this->writerDao->add(['Writer_Name' => $bookDescriptor['Writer_Name'], 'Writer_Last_Name' => $bookDescriptor['Writer_Last_Name']]);
                }
                // no publisher in DB add it
                if (!isset($publisher['id'])) {
                    $publisher = $this->publisherDAO->add(['name' => $bookDescriptor['name']]);
                }

                $this->dao->update(['Book_Name' => $bookDescriptor['Book_Name'],
                                          'Publisher' => $publisher['id'],
                                          'Year_of_publishing' => $bookDescriptor['Year_of_publishing'],
                                          'Book_price' => $bookDescriptor['Book_price'],
                                          'In_inventory' => $bookDescriptor['In_inventory']], $id);


                $book = $this->getByIDWithWriterNames($id);

                $baw = $this->booksAndWritersDAO->getBaW($book['id']);

                $this->booksAndWritersDAO->update(['bookid'=>$book['id'],'writerid'=>$writer['id']], $baw['id']);

                return $book;
            }
        }
    }
