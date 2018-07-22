<?php
  class connect {
    //定数の宣言
    // DB名
    const DB_NAME = 'health';
    // ホスト名
    const HOST = 'localhost';
    // 文字コード
    const UTF = 'utf8mb4';
    // ユーザー名
    const USER = 'root';
    // パスワード
    const PASS = 'root';

    //データベースに接続する関数
    function pdo(){
      // PDO接続に必要な情報を変数に代入
      // 接続情報
      $dsn = "mysql:dbname=".self::DB_NAME.";host=".self::HOST.";charset=".self::UTF;
      // ユーザー名
      $user = self::USER;
      // パスワード
      $pass = self::PASS;

      // try関数内に例外が発生する可能性のある処理を定義
      try{
        // DB接続のPDOクラスをインスタンス化 接続情報, ユーザー名,パスワードを引数に指定
        // DBに接続できない場合
        if (!($pdo = new PDO($dsn, $user, $pass))) {
          // エラーメッセージを投げる
          throw new Exception("DBに接続できません");
        }
      // catch関数でtry関数内の例外を処理
      } catch(Exception $e){
        // エラーメッセージを表示後プログラムを強制終了
        die($e -> getMesseage());
      }
      // DB接続の結果を返す
      return $pdo;
    }
  }
?>