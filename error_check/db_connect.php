<?php
  // データベース名前,ホスト名
  $dsn = 'mysql:dbname=health;host=localhost;charset=utf8mb4;';
  // ユーザー名
  $user = 'root';
  // パスワード
  $password = 'root';
  // try関数内に例外が発生する可能性のある処理を記述
  try {
    // DB接続を行うPDOクラスをインスタンス化
    // コンストラクタで初期値に[データベース名前,ホスト名,ユーザー名,パスワード]を指定
    $db_connect = new PDO($dsn, $user, $password);
    // try関数内で発生した例外をcatch関数で処理
  } catch(PDOException $e){
    // エラーメッセージを表示しdie関数でプログラムを強制終了
    die($e->getMessage());
  }

?>