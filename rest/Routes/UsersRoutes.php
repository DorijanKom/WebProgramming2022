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

        $user = Flight::usersDAO()->getUserByEmail($login['email']);

        if(isset($user['id'])){

            if($user['password'] == md5($login['password'])){ 
                
                unset($user['password']); //Deletes pw from user object so that it isn't encoded inside of the token
                $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
                Flight::json(['token' => $jwt]);

            }else{
                
                Flight::json(["message" => "Incorrect password"], 404);
            }
        }else{
            
            Flight::json(["message" => "User doesn't exist"], 404);
        }
    })
?>