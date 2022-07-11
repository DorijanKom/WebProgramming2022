<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /orders',function(){
    Flight::json(Flight::ordersService()->getOrdersAndUsers());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /orders/@id',function($id){
    Flight::json(Flight::ordersService()->getOrderByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /orders', function(){
    $request=Flight::request();
    $order=Flight::ordersService()->addOrderWithUser($request->data->getData());
    if($order==null){
        Flight::json(['error' => 'Please add book entry before creating order!']);
    } else {
        Flight::json(['message' => 'updated']);
    }
});

Flight::route('PUT /orders/@id',function($id){
    $request=Flight::request();
    $order = Flight::ordersService()->updateOrder($request->data->getData(),$id);
    if($order==null){
        Flight::json(['error' => 'Please add book entry before creating order!']);
    } else {
        Flight::json(['message' => 'updated']);
    }
});

Flight::route('DELETE /orders/@id',function($id){
    Flight::ordersService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>