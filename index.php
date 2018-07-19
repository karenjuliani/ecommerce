<?php

session_start();

//traz as dependencias do projeto
require_once("vendor/autoload.php");

//declarando quais namespace usaremos
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

//criando as ROTAS da aplicação
$app = new Slim();

$app->config('debug', true);

//quando for chamado a pasta raiz será executado todo este bloco do $app->get('/',
$app->get('/', function() {

    $page = new Page();
    
    $page ->setTpl("index");
    
});

$app->get('/admin', function() {

    User::verifyLogin();
    
    $page = new PageAdmin();
    
    $page ->setTpl("index");
    
});

$app->get('/admin/login', function() {

    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);
    
    $page ->setTpl("login");
    
});

$app->post('/admin/login', function() {

    User::login($_POST["login"], $_POST["password"]);
    
    header("Location: /admin");
    
    exit();
});

$app->get('/admin/logout', function() {

    User::logout();
    header("Location: /admin/login");
    exit();
});


//depois de tudo "carregado" ele executa
$app->run();
?>