<?php
require("../vendor/autoload.php");
$openapi = \OpenApi\Generator::scan(['/rest/Routes/*']);
header('Content-Type: application/json');
echo $openapi->toJson();
?>