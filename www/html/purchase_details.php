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

$purchase_id = $_POST['purchase_id'];
$total_price = $_POST['total_price'];
$purchase_datetime = $_POST['purchase_datetime'];

$purchase_details = get_purchase_details($db, $purchase_id);
$get_token = get_post('token');

if(is_valid_csrf_token($get_token)!==true){
  set_error('トークンが不正です');
  redirect_to(HISTORY_URL);
}






include_once VIEW_PATH . 'history_details_view.php';