<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /purchases',function(){
    Flight::json(Flight::purchasesService()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /purchases/@id',function($id){
    Flight::json(Flight::purchasesService()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /purchases', function(){
    $request=Flight::request();
    Flight::purchasesService()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /purchases/@id',function($id){
    $request=Flight::request();
    Flight::purchasesService()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /purchases/@id',function($id){
    Flight::purchasesService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>