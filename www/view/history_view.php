<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'history.css'); ?>">
</head>

<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入履歴</h1>
  <div class="container">

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <?php if (count($purchase_items) > 0) { ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <?php if (is_admin($user)) { ?>
              <th>ユーザーID</th>
            <?php } ?>
            <th>購入番号</th>
            <th>合計金額</th>
            <th>購入日時</th>
            <th>詳細</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($purchase_items as $value) { ?>
            <tr>
              <?php if (is_admin($user)) { ?>
                <td><?php print($value['user_id']); ?></td>
              <?php } ?>
              <td><?php print($value['purchase_id']); ?></td>
              <td><?php print(number_format($value['total_price'])); ?>円</td>
              <td><?php print $value['purchase_datetime'] ?></td>
              <td>
                <form method="post" action="purchase_details.php">
                  <input type="hidden" value="<?php print($value['purchase_id']); ?>" name="purchase_id">
                  <input type="hidden" value="<?php print($value['total_price']); ?>" name="total_price">
                  <input type="hidden" value="<?php print($value['purchase_datetime']); ?>" name="purchase_datetime">
                  <input type="submit" value="詳細">
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } ?>
  </div>

</body>

</html>