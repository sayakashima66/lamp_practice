<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴詳細</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'history_details.css'); ?>">
</head>

<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入履歴詳細</h1>
  <p>注文番号：<?php print($purchase_id); ?></p>
  <p>注文日時：<?php print($purchase_datetime); ?></p>
  <p>合計金額：<?php print($total_price); ?></p>


<div class="container">

<?php include VIEW_PATH . 'templates/messages.php'; ?>

<?php if (count($purchase_details) > 0) { ?>
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th>商品名</th>
        <th>商品価格</th>
        <th>購入数</th>
        <th>小計</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($purchase_details as $value) { ?>
        <tr>
          <td><?php print($value['name']); ?></td>
          <td><?php print(number_format($value['purchase_price'])); ?>円</td>
          <td><?php print($value['item_amount']); ?></td>
          <td><?php print(number_format($value['purchase_price']*$value['item_amount'])); ?>円</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>
</div>

</body>

</html>


