<?php

    require_once __DIR__.'/BaseDAO.class.php';

    class UsersDAO extends BaseDAO{
        
        public function __construct()
        {
            parent::__construct("Users");
        }

        public function getUserByEmail($email){
            return $this->queryUnique("Select * FROM Users WHERE User_email=:email",['email'=>$email]);
        }
}
?>