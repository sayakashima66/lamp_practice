<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'purchase.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$carts = get_user_carts($db, $user['user_id']);

if(purchase_carts($db, $carts) === false){
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
} 

$total_price = sum_carts($carts);
$user_id = $user['user_id'];

if (add_purchase_history($db, $user_id, $total_price) === false){
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
}

if (add_purchase_details($db, $last_purchase_id, $carts) === false){
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
}

include_once '../view/finish_view.php';
