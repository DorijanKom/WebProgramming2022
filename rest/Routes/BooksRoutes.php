<?php


/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 * @OA\Get(
 *      path="/sample/",
 *      tags={"sample"},
 *      summary="Sample endpoint to test the functionality of Flight and Swagger. ",
 *      @OA\Response(
 *          response=200,
 *          description="A sample response."
 *      )
 * )
 */
Flight::route('GET /books',function(){
    Flight::json(Flight::booksDAO()->get_books_with_writer_names());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /books/@id',function($id){
    Flight::json(Flight::booksDAO()->get_by_id_with_writer_names($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /books', function(){
    $request=Flight::request();
    Flight::booksDAO()->add($request->data->getData());
    Flight::json(['message' => 'updated']);
});

Flight::route('PUT /books/@id',function($id){
    $request=Flight::request();
    Flight::booksDAO()->update($request->data->getData(),$id);
    Flight::json(['message' => 'updated']);
});

Flight::route('DELETE /books/@id',function($id){
    Flight::booksDAO()->delete($id);
    Flight::json(['message'=>'deleted']);
});
?>