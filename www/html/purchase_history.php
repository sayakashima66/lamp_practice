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
$user_id = $user['user_id'];

if (is_admin($user) === true){
  $purchase_items = get_all_purchase_history($db, $user_id);
}else if (is_admin($user) === false){
  $purchase_items = get_purchase_history($db, $user_id);
}

include_once VIEW_PATH . 'history_view.php';