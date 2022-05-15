<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;


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

    /**
     * JWT authentication
     */

    Flight::route('POST /login',function(){
        $login = Flight::request()->data->getData();

        print_r($login);

        $key = 'example_key';
        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => 1356999524,
            'nbf' => 1357000000
        ];
        
        $jwt = JWT::encode($payload, $key, 'HS256');
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        print_r($jwt);
        
        print_r($decoded);
    })
?>