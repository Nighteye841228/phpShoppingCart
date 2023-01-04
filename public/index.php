<?php
require_once '../vendor/autoload.php';

use Nighteye1228\PhpTestShopping\ShoppingCart;

$wow = new ShoppingCart();
$wow->addItem("car", 1990)->addItem("car", 1772)->addItem("carrot", 23);
print_r("總數量:" . $wow->getTotalAmount() . "\n");
print_r("總價格:" . $wow->getTotalPrice() . "\n");
