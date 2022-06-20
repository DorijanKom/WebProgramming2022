<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /orders',function(){
    Flight::json(Flight::ordersService()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /orders/@id',function($id){
    Flight::json(Flight::ordersService()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /orders', function(){
    $request=Flight::request();
    Flight::ordersService()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /orders/@id',function($id){
    $request=Flight::request();
    Flight::ordersService()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /orders/@id',function($id){
    Flight::ordersService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>