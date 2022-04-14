<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /purchases',function(){
    Flight::json(Flight::purchasesDAO()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /purchases/@id',function($id){
    Flight::json(Flight::purchasesDAO()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /purchases', function(){
    $request=Flight::request();
    Flight::purchasesDAO()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /purchases/@id',function($id){
    $request=Flight::request();
    Flight::purchasesDAO()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /purchases/@id',function($id){
    Flight::purchasesDAO()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>