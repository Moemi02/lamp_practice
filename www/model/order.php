<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用
function order_transaction($db, $carts){
  $db->beginTransaction();
  if(purchase_carts($db, $carts)){
    $db->commit();
    return true;
  }
  $db->rollback();
  return false;
}

function insert_order($db, $user_id){
  $sql = "
  INSERT INTO
    orders(user_id)
    VALUES (:user_id);
  ";
  $params = array(
    ':user_id' => $user_id
  );
  return execute_query($db, $sql, $params);
  //execute_query関数でいいのか？  
}

//ログインユーザの注文の新着順にソートした購入履歴を取得する関数
function get_orders($db, $user_id){
  $sql = '
    SELECT
      orders.user_id,
      orders.order_id,  
      orders.created,
      SUM(order_details.ordered_price * order_details.ordered_amount) AS total_price
    FROM
      orders
      INNER JOIN order_details
      ON orders.order_id = order_details.order_id
    GROUP BY
      orders.order_id  
    HAVING
      orders.user_id = :user_id
    ORDER BY
      orders.created DESC   
  ';
  $params = array(':user_id' => $user_id);
  return fetch_all_query($db, $sql, $params);
}

function get_all_orders($db){
  $sql = '
    SELECT
      orders.user_id,
      orders.order_id,  
      orders.created,
      SUM(order_details.ordered_price * order_details.ordered_amount) AS total_price
    FROM
      orders
      INNER JOIN order_details
      ON orders.order_id = order_details.order_id
    GROUP BY
      orders.order_id  
    ORDER BY
      orders.created DESC   
  ';
  return fetch_all_query($db, $sql);
}

function get_order($db, $order_id){
  $sql = '
    SELECT
      orders.order_id,
      orders.user_id,  
      orders.created,
      SUM(order_details.ordered_price * order_details.ordered_amount) AS total_price
    FROM
      orders
      INNER JOIN order_details
      ON orders.order_id = order_details.order_id
    WHERE
      orders.order_id = :order_id
    GROUP BY
      orders.order_id  
  ';
  $params = array(
    ':order_id' => $order_id,
  );
  return fetch_query($db, $sql, $params);
}

function is_valid_order_id($order_id){
  $is_valid = true;
  if(is_positive_integer($order_id) === false){
    set_error('不正なアクセスです。');
    $is_valid = false;
  }
  return $is_valid;
}
