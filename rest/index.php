<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/Services/BooksService.class.php';
require_once __DIR__.'/Services/OrdersService.class.php';
require_once __DIR__.'/Services/PurchasesService.class.php';
require_once __DIR__.'/Services/UsersService.class.php';
require_once __DIR__.'/Services/WritersService.class.php';

Flight::register('booksDAO','BooksDAO');
Flight::register('purchasesDAO','PurchaseDAO');
Flight::register('ordersDAO','OrdersDAO');
Flight::register('writersDAO','WritersDAO');
Flight::register('usersDAO','UsersDAO');

Flight::map('error', function(Exception $e){
    Flight::json(['message'=> $e->getMessage()], 500);
});

require_once __DIR__.'/Routes/BooksRoutes.php';
require_once __DIR__.'/Routes/PurchasesRoutes.php';
require_once __DIR__.'/Routes/OrdersRoutes.php';
require_once __DIR__.'/Routes/UsersRoutes.php';
require_once __DIR__.'/Routes/WritersRoutes.php';


Flight::start();
?>
