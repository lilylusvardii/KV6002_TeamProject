<?php
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
include("config/autoloader.php");
spl_autoload_register("autoloader");
 
$response = new Response();
  
try {
switch ($endpointName) {
    case '/events':
        $endpoint = new Events();
        break;
    case '/login':
       $endpoint = new Login();
        break;
    case '/signup':
        $endpoint = new SignUp();
        break;

    $endpoint = new Endpoint(['message' => 'No option specified']);
}
} catch (ClientError $e) { 
    $data = ['message' => $e->getMessage()];
    $endpoint = new Endpoint($data);
}
 
$data = $endpoint->getData();
 
$response->outputJSON($data);