<?php
// define('SECURE_ACCESS', true);
// define('ROOT_PATH', __DIR__);
// session_start();
// echo session_id();
// if (!file_exists(ROOT_PATH . '/../../../config.php')) {
//    echo'Path not exist filaed';
//    die;
// }
// require_once ROOT_PATH . '/../../../config.php';

//  define('SECURE_ACCESS', true);
//  define('ROOT_PATH', __DIR__);
 
require_once 'CustomerController.php';


 $controller = new CustomerController();
 $controller->handleRequest($_GET['action']);



?>