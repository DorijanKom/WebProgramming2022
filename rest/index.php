<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ('../vendor/autoload.php');
require_once ('DAO/BooksDAO.class.php');

Flight::register('booksDAO','BooksDAO');

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /books',function(){
    Flight::json(Flight::booksDAO()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /books/@id',function($id){
    Flight::json(Flight::booksDAO()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /books', function(){
    $request=Flight::request();
    Flight::booksDAO()->add($request->data->getData());
});

Flight::start();
?>
