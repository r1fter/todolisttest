<?php
define('_DS', DIRECTORY_SEPARATOR);

use \Models\Task;

include '.'._DS.'..'._DS.'autoload.php';
include dirname(__DIR__)._DS.'config'._DS.'main.php';

session_start();
session_regenerate_id();

global $is_admin;
$is_admin = isset($_SESSION['user']);

$router = new Router();
$router->run($_SERVER['REQUEST_URI']);
