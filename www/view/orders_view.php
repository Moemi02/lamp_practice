<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴画面</title>
  <link rel="stylesheet" href="<?php print h(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入履歴画面</h1>

  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <?php if(count($orders) > 0){ ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>注文番号</th>
            <th>購入日時</th>
            <th>該当の注文の合計金額</th>
            <th>購入明細</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($orders as $order){ ?>
          <tr>
            <td><?php print h($order['order_id']);?></td>
            <td><?php print h($order['created']); ?></td>
            <td><?php print h($order['total_price']); ?>円</td>
            <form  method="get">
              <td><input type="submit" value="購入明細表示"></td>
                  <input type="hidden" name="order_id" value="<?php print h($order['order_id']); ?>">
            </form>  
          </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>購入履歴はありません。</p>
    <?php } ?> 
  </div>
</body>
</html>