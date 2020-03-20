<?php
// 定数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once '../model/functions.php';
// orderデータに関する関数ファイルを読み込み。
require_once '../model/order.php';
require_once '../model/order_detail.php';

// ログインチェックを行う
session_start();

// ログインチェック用関数を利用
if(is_logined() === false){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

// PDOを取得
$db = get_db_connect();

// 注文番号のデータを取得
$order_id = get_get('order_id')

//該当の注文番号の購入履歴を取得する。
$order = get_order($db, $order_id);

//該当の注文番号の購入明細を取得する。
$order_details = get_order_details($db, $order_id);

include_once VIEW_PATH . 'order_details_view.php';