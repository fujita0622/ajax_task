<?php
  header('Content-type: text/plain; charset= UTF-8');
  // ログインID
  $login_id = $_POST['login_id'];
  // ログインパスワード
  $login_password = $_POST['login_password'];
  // DB接続ファイルを読み込み
  require_once 'db_connect.php';
  // ログイン情報テーブルから全てのデータを取得
  $stmt = $db -> query("SELECT * FROM user_info");
  // DBから取得したデータをループ処理で表示
  try {
    while($line = $stmt -> fetch(PDO::FETCH_ASSOC)) {
      // ログインID、ログインパスワードがDBに登録されているログイン情報と一致しているか判断
      // 一致している場合
      if ($login_id == $line['login_id'] AND $login_password == $line['login_password']) {
        // ログイン成功情報をcookieに送信
        setcookie("login_State", $line['user_name'], time()+(3 * 24 * 60 * 60));
        // ログイン情報を入れる
        $check_var = $line['user_name'];
        // ログイン画面を表示
        echo "ログイン成功しました。<br>";
        echo $line['user_name'] . "様<br>";
      }
    } 
    // $check_varにログイン情報がセットされていない場合
    if (!isset($check_var)) {
      // エラー処理を投げる
      echo "ログイン失敗しました。<br>";
    }
    // catch関数で発生した例外を処理
  } catch(Exception $e) {
    // エラーメッセージを表示し、プログラムを強制終了
    die($e -> getMessage());
  }
?>

