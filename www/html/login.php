<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';

session_start();

if(is_logined() === true){
  redirect_to(HOME_URL);
}

$csrf_token = get_csrf_token();
//modelから持ってくるときget_という名称、viewで使うものを変数に
include_once VIEW_PATH . 'login_view.php';