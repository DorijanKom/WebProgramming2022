<?php


/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /writers',function(){
    Flight::json(Flight::writerssDAO()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /writers/@id',function($id){
    Flight::json(Flight::writersDAO()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /writers', function(){
    $request=Flight::request();
    Flight::writersDAO()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /writers/@id',function($id){
    $request=Flight::request();
    Flight::writersDAO()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /writers/@id',function($id){
    Flight::writersDAO()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>