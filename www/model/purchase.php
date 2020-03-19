<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'cart.php';


function add_purchase_history($db, $user_id, $total_price)
{
    insert_purchase_history($db, $user_id, $total_price);
    get_last_purchase_id($db);
}

function insert_purchase_history($db, $user_id, $total_price)
{
    $sql = "
      INSERT INTO
      purchase_history(
          user_id,
          total_price
          )
        VALUES({$user_id},{$total_price})
        ";

    return execute_query($db, $sql);
}


//最新のpurchase_idを取得
function get_last_purchase_id($db)
{
    global $last_purchase_id;
    $last_purchase_id = $db->lastInsertId('purchase_id');
}

function add_purchase_details($db, $last_purchase_id, $carts)
{
    foreach ($carts as $value) {

        $purchase_item_id = $value["item_id"];
        $purchase_item_amount = $value["amount"];
        $purchase_price = $value["price"];

        insert_purchase_details($db, $last_purchase_id, $purchase_item_id, $purchase_item_amount, $purchase_price);
    }
}

function insert_purchase_details($db, $last_purchase_id, $purchase_item_id, $purchase_item_amount, $purchase_price)
{
    $sql = "
      INSERT INTO
      purchase_details(
          purchase_id,
          item_id,
          item_amount,
          purchase_price
          )
        VALUES({$last_purchase_id},{$purchase_item_id},{$purchase_item_amount},{$purchase_price})
        
        ";

    return execute_query($db, $sql);
}


function get_purchase_history($db, $user_id)
{

    $sql = "SELECT
    purchase_id, total_price, purchase_datetime
    FROM purchase_history
    WHERE {$user_id} = user_id
    ";

    return fetch_all_query($db, $sql);
}

function get_all_purchase_history($db, $user_id)
{

    $sql = "SELECT *
    FROM purchase_history
    ORDER BY purchase_datetime DESC
    ";

    return fetch_all_query($db, $sql);
}

function get_purchase_details($db, $purchase_id){
    $sql = 
    "SELECT
    a.item_id,
    a.item_amount,
    a.purchase_price,
    a.details_datetime,
    b.name
    FROM purchase_details as a
    join items as b
    on a.item_id = b.item_id
    where a.purchase_id = {$purchase_id}
    ";

    return fetch_all_query($db, $sql); 
}

