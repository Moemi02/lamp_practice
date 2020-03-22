<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入明細画面</title>
  <link rel="stylesheet" href="<?php print h(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入明細画面</h1>

  <div class="container">
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <?php if(count($order_details) > 0){ ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>注文番号</th>
            <th>購入日時</th>
            <th>合計金額</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php print h($order['order_id']);?></td>
            <td><?php print h($order['created']); ?></td>
            <td><?php print h($order['total_price']); ?>円</td>
          </tr>
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>商品名</th>
            <th>購入時の商品価格</th>
            <th>購入数</th>
            <th>小計</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($order_details as $order_detail){ ?>
          <tr>
            <td><?php print h($order_detail['name']);?></td>
            <td><?php print h($order_detail['ordered_price']); ?>円</td>
            <td><?php print h($order_detail['ordered_amount']);?></td>
            <td><?php print h($order_detail['sub_total_price']); ?>円</td>
          </tr>
          <?php } ?>
        </tbody>        
      </table>
    <?php } else { ?>
      <p>購入明細はありません。</p>
    <?php } ?> 
  </div>
</body>
</html>