<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /publishers',function(){
    Flight::json(Flight::publisherService()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /publishers/@id',function($id){
    Flight::json(Flight::publisherService()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /publishers', function(){
    $request=Flight::request();
    Flight::publisherService()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /publishers/@id',function($id){
    $request=Flight::request();
    Flight::publisherService()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /publishers/@id',function($id){
    Flight::publisherService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>