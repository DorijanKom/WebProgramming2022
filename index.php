<?php
require 'vendor/autoload.php';  //run autoloader

Flight::route('/', function(){ //define route and define functions to handel request
	echo 'Hello world!';
});

Flight::start();	//start FlightPHP

ini_set('display errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once("rest/DAO/BookstoreDAO.class.php");


$dao=new BookstoreDAO();
$result=$dao->add("Writers",array("Writer_Name"=>"Jack","Writer_Last_Name"=>"Smith"));
$result=$dao->getAll("Writers");
$result=$dao->update("Writers",array("Writer_Name"=>"Kenan"),5);
$result=$dao->getAll("Writers");
$result=$dao->delete("Writers",5);
$result=$dao->getAll("Writers");
print_r($result);


?>
