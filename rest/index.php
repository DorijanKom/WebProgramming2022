<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
require_once 'DAO/BaseDAO.class.php';


Flight::route('/', function(){
    echo 'helsslo world!';
});

Flight::route('/abc', function(){
    echo 'helsslo world! abc';
});

Flight::start();
?>
