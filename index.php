<?php

//traz as dependencias do projeto
require_once("vendor/autoload.php");

//declarando quais namespace usaremos
use \Slim\Slim;
use \Hcode\Page;

//criando as ROTAS da aplicação
$app = new Slim();

$app->config('debug', true);

//quando for chamado a pasta raiz será executado todo este bloco do $app->get('/',
$app->get('/', function() {

    $page = new Page();
    
    $page ->setTpl("index");
    
});

//depois de tudo "carregado" ele executa
$app->run();
?>