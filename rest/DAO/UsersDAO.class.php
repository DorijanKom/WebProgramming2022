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

        public function getUserByName($name, $lastname){
            return $this->queryUnique("SELECT * FROM Users WHERE User_Name =:name AND User_Last_Name=:lastname",['name'=>$name,'lastname'=>$lastname]);
        }
}
?>