<?php
// 定数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once '../model/functions.php';
// userデータに関する関数ファイルを読み込み
require_once '../model/user.php';
// itemデータに関する関数ファイルを読み込み。
require_once '../model/item.php';

// ログインチェックを行うため、セッションを開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === false){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

// 商品の並び替えデータを取得
$display_item = get_get('display_item');

// PDOを取得
$db = get_db_connect();
// PDOを利用してログインユーザーのデータを取得
$user = get_login_user($db);

// 商品一覧用の商品データを取得
$items = get_open_items($db, $display_item);

$csrf_token = get_csrf_token();
//modelから持ってくるときget_という名称、viewで使うものを変数に
// ビューの読み込み。
include_once VIEW_PATH . 'index_view.php';