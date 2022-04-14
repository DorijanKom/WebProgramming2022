<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /orders',function(){
    Flight::json(Flight::ordersDAO()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /orders/@id',function($id){
    Flight::json(Flight::ordersDAO()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /orders', function(){
    $request=Flight::request();
    Flight::ordersDAO()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /orders/@id',function($id){
    $request=Flight::request();
    Flight::orderssDAO()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /orders/@id',function($id){
    Flight::ordersDAO()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>