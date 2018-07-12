<?php
  $login_id = $_POST['login_id'];
  $login_password = $_POST['login_password'];
  // DB接続ファイルを読み込み
  require_once 'db_connect.php';
  $stmt = $db -> query("SELECT * FROM user_info");
  // DBから取得したデータをループ処理で表示
  while($line = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    // try {
      if ($login_id == $line['login_id'] AND $login_password == $line['login_password']) {
        setcookie("login_State", $line['user_name'], time()+(3 * 24 * 60 * 60));
        echo "ログイン成功しました。<br>";
        echo $line['user_id'] . "様<br>";
        break;
      } 

    //   else {
    //     throw new Exception("ログイン失敗しました。");
    //   }
    // } catch(Exception $e) {
    //   die($e -> getMessage());
    // }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>ログイン画面</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<form action="login.php" method="POST">
  ID：<input type="text" name="login_id">
  パスワード：<input type="text" name="login_password">
  <input type="submit" value="ログイン">
</form>
</body>
</html>
<?php
  echo $_COOKIE['user_id'];
?>
