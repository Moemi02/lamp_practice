<?php
// 定数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once '../model/functions.php';
// userデータに関する関数ファイルを読み込み
require_once '../model/user.php';
// orderデータに関する関数ファイルを読み込み。
require_once '../model/order.php';

// ログインチェックを行う
session_start();

// ログインチェック用関数を利用
if(is_logined() === false){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

// PDOを取得
$db = get_db_connect();
// PDOを利用してログインユーザーのデータを取得
$user = get_login_user($db);
//ログインユーザの購入履歴を取得
$orders = get_orders($db, $user['user_id']);

include_once VIEW_PATH . 'orders_view.php';