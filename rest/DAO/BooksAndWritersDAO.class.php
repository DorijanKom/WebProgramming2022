<?php
    class BooksAndWritersDAO extends BaseDAO {
        public function __construct()
        {
            parent::__construct("BooksAndWriters");
        }

        public function getBaW($bookid){
            return $this->queryUnique("SELECT * FROM BooksAndWriters WHERE bookid=:bookid",['bookid'=>$bookid]);
        }
    }
?>