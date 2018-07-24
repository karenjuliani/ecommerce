<?php
use Hcode\Page;

//quando for chamado a pasta raiz será executado todo este bloco do $app->get('/',
$app->get('/', function() {

    $page = new Page();

    $page->setTpl("index");
});


