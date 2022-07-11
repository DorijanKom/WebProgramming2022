<?php

/**
 * The following are methods for basic CRUD operations implemented in flight
 */


/**
 *  Returns all items from the table
 */
Flight::route('GET /purchases',function(){
    Flight::json(Flight::purchasesService()->getPurchaseAndBookAndUser());
});

/**
 *  Returns one from the table by ID
 */
Flight::route('GET /purchases/@id',function($id){
    Flight::json(Flight::purchasesService()->getPurchaseAndBookAndUserById($id));
});

/**
 *  Adds new data to the table
 */
Flight::route('POST /purchases', function(){
    $request=Flight::request();
    $purchase = Flight::purchasesService()->addPurchase($request->data->getData());
    if($purchase == null){
        Flight::json(['error' => 'The inventory of chosen book is empty!']);
    } else {
        Flight::json(['message' => 'Sold!']);
    }
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