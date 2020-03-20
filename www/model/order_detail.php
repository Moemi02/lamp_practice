<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function insert_order_detail($db, $order_id, $item_id, $ordered_price, $ordered_amount){
  $sql = "
  INSERT INTO
    order_details(order_id, item_id, ordered_price, ordered_amount)
    VALUES (:order_id, :item_id, :ordered_price, :ordered_amount);
  ";
  $params = array(
    ':order_id' => $order_id,
    ':item_id' => $item_id,
    ':ordered_price' => $ordered_price,
    ':ordered_amount' => $ordered_amount
  );
  return execute_query($db, $sql, $params);
  //execute_query関数でいいのか？  
}

function get_order_details($db, $order_id){
  $sql = '
  SELECT
    items.name,
    order_details.ordered_price,
    order_details.ordered_amount,
    order_details.ordered_price * order_details.ordered_amount AS sub_total_price
  FROM
    items
    INNER JOIN order_details
    ON items.item_id = order_details.item_id
  WHERE
    order_details.order_id = :order_id
';
$params = array(':order_id' => $order_id);
return fetch_all_query($db, $sql, $params);
}