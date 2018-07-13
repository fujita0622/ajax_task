<?php if (isset($_COOKIE['login_State'])) : ?>
  <p>ログイン成功しました。</p>
  <p><?php echo $_COOKIE['login_State']; ?>様</p>
  <?php exit; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>ログイン画面</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<form action="login_check.php" method="POST">
  ID：<input type="text" name="login_id">
  パスワード：<input type="text" name="login_password">
  <input type="submit" value="ログイン">
  <div id="result"></div>
</form>
</body>
</html>
<!-- <script type="text/javascript">
  var request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    var result = document.getElementById('result');
    if (req.readyState == 4) { // 通信の完了時
      if (req.status == 200) { // 通信の成功時
        result.innerHTML = req.responseText;
      }
    }else{
      result.innerHTML = "通信中...";
    }
  }

  request.open('POST', 'helloAjax.php', true);
  request.setRequestHeader('content-type',
  'application/x-www-form-urlencoded;charset=UTF-8');
  request.send('name=' + encodeURIComponent(document.fm.name.value));
</script> -->