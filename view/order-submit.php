<?php
if(isset($_SESSION["cart"])) $kosara = $_SESSION["cart"];

// add new order, status 1 means oddano, default seller is Vanesa Godec
$order_id = OrdersController::add(["id_user" => $_SESSION["id"], "id_seller" => 2, "status" => 1]);
foreach($kosara as $id => $kolicina):
    OrderArticlesController::add(["id_order" => $order_id, "id_article" => $id, "amount" => $kolicina]);
endforeach;
 
// Unset the cart
$_SESSION["cart"] = array();
  
// Redirect to login page
header("location:". BASE_URL . "orders");
exit;
?>