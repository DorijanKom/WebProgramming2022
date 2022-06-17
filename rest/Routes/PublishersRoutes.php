<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /orders',function(){
    Flight::json(Flight::publisherDAO()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /orders/@id',function($id){
    Flight::json(Flight::publisherDAO()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /orders', function(){
    $request=Flight::request();
    Flight::publisherDAO()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /orders/@id',function($id){
    $request=Flight::request();
    Flight::publisherDAO()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /orders/@id',function($id){
    Flight::publisherDAO()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>