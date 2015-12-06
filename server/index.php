<?php 
require_once 'assets/handle.php';
global $handler;
$response=$handler->parse($_GET);  

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
echo $response;