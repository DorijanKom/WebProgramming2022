<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;


    /**
     * The following are methods for basic CRUD operations implemented in flight
     */


/**
 * @OA\Get(path="/users/", tags={"users"}, summary="Returns all users from the api. ", security={{"ApiKeyAuth": {}}},
 *      @OA\Response( response=200, description="List of users")
 *  )
 */
    Flight::route('GET /users',function(){
        Flight::json(Flight::usersService()->getAll());
    });

    /**
     *  Returns one from the table by ID
     */
    Flight::route('GET /users/@id',function($id){
        Flight::json(Flight::usersService()->getByID($id));
    });

    /**
     *  Adds new data to the table
     */
    Flight::route('POST /users', function(){
        $request=Flight::request();
        Flight::usersService()->add($request->data->getData());
        Flight::json(['message' => 'updated']);
    });

    Flight::route('PUT /users/@id',function($id){
        $request=Flight::request();
        Flight::usersService()->update($request->data->getData(),$id);
        Flight::json(['message' => 'updated']);
    });

    Flight::route('DELETE /users/@id',function($id){
        Flight::usersService()->delete($id);
        Flight::json(['message'=>'deleted']);
    });

    /**
     * JWT authentication
     */

    /**
     * @OA\Post(
     *     path="/login",
     *     description="Login to the system",
     *     tags={"JWT"},
     *     @OA\RequestBody(description="Basic user info", required=true,
     *       @OA\MediaType(mediaType="application/json",
     *    			@OA\Schema(
     *    				@OA\Property(property="email", type="string", example="dorijan.komsic@stu.ibu.edu.ba",	description="Email"),
     *    				@OA\Property(property="password", type="string", example="12345",	description="Password" )
     *          )
     *     )),
     *     @OA\Response(
     *         response=200,
     *         description="JWT token on successful response",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="unauthorized",
     *     )
     * )
     */

    Flight::route('POST /login',function(){
        $login = Flight::request()->data->getData();

        $user = Flight::usersService()->getUserByEmail($login['email']);

        if(isset($user['id'])){

            if($user['password'] == md5($login['password'])){ // md5 hash compatible
                
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