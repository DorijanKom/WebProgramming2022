<?php
require 'vendor/autoload.php';  //run autoloader

Flight::route('/', function(){ //define route and define functions to handel request
	echo 'Hello world!';
});

Flight::start();	//start FlightPHP
?>
