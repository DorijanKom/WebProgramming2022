<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /baw',function(){
    Flight::json(Flight::booksAndWritersService()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /baw/@id',function($id){
    Flight::json(Flight::booksAndWritersService()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /baw', function(){
    $request=Flight::request();
    Flight::booksAndWritersService()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /baw/@id',function($id){
    $request=Flight::request();
    Flight::booksAndWritersService()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /baw/@id',function($id){
    Flight::booksAndWritersService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>