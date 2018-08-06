<?php

session_start();

//traz as dependencias do projeto
require_once("vendor/autoload.php");

//declarando quais namespace usaremos
use Slim\Slim;

//criando as ROTAS da aplicação
$app = new Slim();

$app->config('debug', true);

require_once("site.php");
require_once("admin.php");
require_once("admin-users.php");
require_once("admin-categories.php");
require_once("admin-products.php");
require_once("admin-orders.php");
require_once("functions.php");

//depois de tudo "carregado" ele executa
$app->run();
?>