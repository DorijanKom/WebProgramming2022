<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class WritersDAO extends BaseDAO {
        public function __construct()
        {
            parent::__construct("Writers");
        }

        public function getWriterByNames($lastName, $firstName){
          return $this->queryUnique("SELECT *
                                     FROM writers
                                     WHERE Writer_Name = :first_name AND Writer_Last_Name = :last_name", ['first_name' => $firstName, 'last_name' => $lastName]);
        }
}
?>
