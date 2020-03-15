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

        insert_purchase_details($db, $last_purchase_id, $purchase_item_id, $purchase_item_amount);
    }
}

function insert_purchase_details($db, $last_purchase_id, $purchase_item_id, $purchase_item_amount)
{
    print "last_purchase_idは".$last_purchase_id."<br>";
    var_dump($last_purchase_id);

    $sql = "
      INSERT INTO
      purchase_details(
          purchase_id,
          item_id,
          item_amount
          )
        VALUES({$last_purchase_id},{$purchase_item_id},{$purchase_item_amount})
        
        ";

    return execute_query($db, $sql);
}

//VALUES({$last_purchase_id}, {$purchase_item_id}, {$purchase_item_amount})