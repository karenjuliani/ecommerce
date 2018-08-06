<?php

use Hcode\Model\Order;
use Hcode\Model\OrderStatus;
use Hcode\Model\User;
use Hcode\PageAdmin;

$app->get("/admin/orders/:idorder/status", function($idorder) {
    User::verifyLogin();

    $order = new Order();
    $order->get((int) $idorder);

    $page = new PageAdmin();

    $page->setTpl("order-status", [
        "order" => $order->getValues(),
        "status" => OrderStatus::listAll(),
        "msgError" => Order::getError(),
        "msgSuccess" => Order::getSuccess()
    ]);

//    header("Location: /admin/orders");
//    exit();
});

$app->post("/admin/orders/:idorder/status", function($idorder) {
    User::verifyLogin();

    if (!isset($_POST['idstatus']) || !(int) $_POST['idstatus'] > 0) {
        Order::setError("Informe o status atual");
        header("Location: /admin/orders/$idorder/status");
        exit();
    }

    $order = new Order();
    $order->get((int) $idorder);

    //$order->setidstatus();

    $order->save($order->getidorder(), $order->getidcart(), $order->getiduser(), (int) $_POST['idstatus'], $order->getidaddress(), $order->getvltotal());
    
    Order::setSuccess("Status atualizado");
     header("Location: /admin/orders/$idorder/status");
    exit();
});

$app->get("/admin/orders/:idorder/delete", function($idorder) {
    User::verifyLogin();

    $order = new Order();
    $order->get((int) $idorder);

    $order->delete();

    header("Location: /admin/orders");
    exit();
});

$app->get("/admin/orders/:idorder", function($idorder) {
    User::verifyLogin();

    $order = new Order();
    $order->get((int) $idorder);
    $cart = $order->getCart();

    $page = new PageAdmin();

    $page->setTpl("order", [
        "order" => $order->getValues(),
        "cart" => $cart->getValues(),
        "products" => $cart->getProducts()
    ]);
});

$app->get("/admin/orders", function() {
    User::verifyLogin();

    $page = new PageAdmin;

    $page->setTpl("orders", [
        "orders" => Order::listAll()
    ]);
});

