<?php


/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 * @OA\Get(path="/books/", tags={"books"}, summary="Returns all books from the api. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response(response=200,description="List of books")
 * )
 */
Flight::route('GET /books',function(){
    Flight::json(Flight::booksDAO()->get_books_with_writer_names());
});

/**
 * @OA\Get(path="/books/{id}", tags={"books"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of book"),
 *     @OA\Response(response="200", description="Fetch individual book")
 * )
 */
Flight::route('GET /books/@id',function($id){
    Flight::json(Flight::booksDAO()->get_by_id_with_writer_names($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /books', function(){
    $data=Flight::request()->data->getData();
    $book = Flight::booksService()->addBookAndWriter($data);
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
