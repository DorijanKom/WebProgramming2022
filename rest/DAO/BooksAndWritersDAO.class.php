<?php
    class BooksAndWritersDAO extends BaseDAO {
        public function __construct()
        {
            parent::__construct("BooksAndWriters");
        }

        public function getBaW($bookid){
            return $this->queryUnique("SELECT * FROM BooksAndWriters WHERE bookid=:bookid",['bookid'=>$bookid]);
        }

        public function deleteBook($bookid){
            $stm = $this->conn->prepare("DELETE FROM BooksAndWriters WHERE bookid = :bookid");
            $stm->bindParam(':bookid',$bookid);
            $stm->execute();
        }

        public function deleteWriter($writerid)
        {
            $stm = $this->conn->prepare("DELETE FROM BooksAndWriters WHERE writerid = :writerid");
            $stm->bindParam(';writerid',$writerid);
            $stm->execute();
        }
    }
?>