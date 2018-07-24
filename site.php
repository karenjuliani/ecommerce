<?php

use Hcode\Model\Product;
use Hcode\Page;

//quando for chamado a pasta raiz será executado todo este bloco do $app->get('/',
$app->get('/', function() {

    $products = Product::listAll();

    $page = new Page();

    $page->setTpl("index", [
        'products' =>  Product::checkList($products)
    ]);
});


