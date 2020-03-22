<?php
// 定数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once '../model/functions.php';
// userデータに関する関数ファイルを読み込み
require_once '../model/user.php';
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

// 注文番号のデータを取得
$order_id = get_get('order_id');

//バリデーション
if (is_valid_order_id($order_id) === FALSE){
  redirect_to(ORDER_URL);
}

// PDOを取得
$db = get_db_connect();

// PDOを利用してログインユーザーのデータを取得
$user = get_login_user($db);

//該当の注文番号の購入履歴を取得する。
$order = get_order($db, $order_id); 

//該当の購入履歴のユーザIDと、ログインユーザのユーザIDの一致を確認し、異なる場合はエラーメッセージとリダイレクトを行う
if(is_admin($user) === FALSE && $order['user_id'] !== $user['user_id']){
  set_error('不正なアクセスです。');
  redirect_to(ORDER_URL);
} 

//ログインユーザの購入明細を取得
$order_details = get_order_details_by_order_id($db, $order_id);

include_once VIEW_PATH . 'order_details_view.php';