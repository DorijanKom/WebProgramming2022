<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ('../vendor/autoload.php');
require_once ('DAO/BooksDAO.class.php');

flight::register('booksDAO','BooksDAO');

/**
 * The following are methods for basic CRUD operations implemented in flight
 */

flight::route('GET /books',function(){
    flight::json(flight::booksDAO()->getAll());
});


flight::route('GET /books/@id',function($id){
    flight::json(flight::booksDAO()->getByID($id));
});

Flight::start();
?>
