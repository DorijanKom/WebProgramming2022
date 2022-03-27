<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ('../vendor/autoload.php');
require_once ('DAO/BooksDAO.class.php');

flight::register('booksDAO','BooksDAO');


flight::route('GET /books',function(){
    $books=flight::booksDAO()->getAll();
    flight::json($books);
});

flight::route('GET /books/$id',function($id){
    $books=flight::booksDAO()->getByID($id);
    flight::json($books);
});

Flight::start();
?>
