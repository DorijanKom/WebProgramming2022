<?php


/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /writers',function(){
    Flight::json(Flight::writersService()->getAll());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /writers/@id',function($id){
    Flight::json(Flight::writersService()->getByID($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /writers', function(){
    $request=Flight::request();
    Flight::writersService()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /writers/@id',function($id){
    $request=Flight::request();
    Flight::writersService()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /writers/@id',function($id){
    Flight::booksAndWritersService()->deleteWriter($id);
    Flight::writersService()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>