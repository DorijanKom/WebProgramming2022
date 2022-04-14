<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/DAO/BooksDAO.class.php';

Flight::register('booksDAO','BooksDAO');
Flight::register('purchasesDAO','PurchasesDAO');
Flight::register('ordersDAO','OrdersDAO');
Flight::register('writersDAO','WritersDAO');
Flight::register('usersDAO','UsersDAO');


require __DIR__.'/Routes/BooksRoutes.php';


Flight::start();
?>
