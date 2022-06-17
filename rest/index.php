<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/Services/BooksService.class.php';
require_once __DIR__.'/Services/OrdersService.class.php';
require_once __DIR__.'/Services/PurchasesService.class.php';
require_once __DIR__.'/Services/UsersService.class.php';
require_once __DIR__.'/Services/WritersService.class.php';
require_once __DIR__.'/Services/PublishersService.class.php';

Flight::register('booksService','BooksService');
Flight::register('booksDAO','BooksDAO');
Flight::register('purchasesDAO','PurchaseDAO');
Flight::register('ordersDAO','OrdersDAO');
Flight::register('writersDAO','WritersDAO');
Flight::register('usersDAO','UsersDAO');
Flight::register('publisherDAO','PublisherDAO');

Flight::map('error', function(Exception $e){
    Flight::json(['message'=> $e->getMessage()], 500);
});

Flight::route('/*', function(){

    $path = Flight::request()->url;
    if ($path == '/login' || $path == '/docs.json' || $path == '/test/*') return TRUE;
  
    $headers = getallheaders();
    if (@!$headers['Authorization']){
      Flight::json(["message" => "Authorization is missing"], 403);
      return FALSE;
    }else{
      try {
        $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
        Flight::set('user', $decoded);
        return TRUE;
      } catch (\Exception $e) {
        Flight::json(["message" => "Authorization token is not valid"], 403);
        return FALSE;
      }
    }
  });

  // REST api documentation end-point
  Flight::route('GET /docs.json',function(){
    $openapi = \OpenApi\Generator::scan(['Routes']);
    header('Content-Type: application/json');
    echo $openapi->toJson();
});

require_once __DIR__.'/Routes/BooksRoutes.php';
require_once __DIR__.'/Routes/PurchasesRoutes.php';
require_once __DIR__.'/Routes/OrdersRoutes.php';
require_once __DIR__.'/Routes/UsersRoutes.php';
require_once __DIR__.'/Routes/WritersRoutes.php';
require_once __DIR__.'/Routes/PublishersRoutes.php';


Flight::start();
?>
