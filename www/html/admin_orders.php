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

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();

$user = get_login_user($db);

//ログインユーザが管理者でなければログインユーザの購入履歴以外は閲覧できないようにする。
if(is_admin($user) === false){
  redirect_to(ORDER_URL);
}

//全ての購入履歴を取得する。
$all_orders = get_all_orders($db);

include_once VIEW_PATH . '/admin_orders_view.php';