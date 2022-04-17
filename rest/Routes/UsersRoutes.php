<?php


/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /users',function(){
    Flight::json(Flight::usersDAO()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /users/@id',function($id){
    Flight::json(Flight::usersDAO()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /users', function(){
    $request=Flight::request();
    Flight::usersDAO()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /users/@id',function($id){
    $request=Flight::request();
    Flight::usersDAO()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /users/@id',function($id){
    Flight::usersDAO()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>