<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /baw',function(){
    Flight::json(Flight::booksAndWritersDAO()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /baw/@id',function($id){
    Flight::json(Flight::booksAndWritersDAO()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /baw', function(){
    $request=Flight::request();
    Flight::booksAndWritersDAO()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /baw/@id',function($id){
    $request=Flight::request();
    Flight::booksAndWritersDAO()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /baw/@id',function($id){
    Flight::booksAndWritersDAO()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>