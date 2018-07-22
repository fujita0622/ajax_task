<?php
  // 誕生日のオプションタグを選択範囲分ループ処理して表示する関数
  function get_birthday_range($first, $last) {
    // 引数で指定した範囲を戻り値で返す配列を定義
    $array = array();
    // 初期値にオプションタグの最初の値($first)を指定
    // オプションタグの最初の値($last)でループを終了
    for ($count = $first; $count <= $last; $count++) { 
      // オプションタグの値が1桁の場合
      if (strlen($count) === 1) {
        // str_pad関数で左に0埋めで2桁に整形
        $count = str_pad($count, 2, 0, STR_PAD_LEFT);
      } // if end
      // 配列に代入
      $array[] = $count;
    } // for end
    // 引数で指定した範囲が代入された配列を返す
    return $array;
  } // get_birthday_range end

  // DBからFORMの各項目の初期値を取得する関数
  function export_initial_value($item_name ,$user_id) {
    // 第一引数で指定された列名から user_id列 の値が 第二引数に指定された値と一致したカラムを取得するSQL文を定義
    $sql = "SELECT {$item_name} FROM user_health_info WHERE user_id = (:user_id)";
    // DBに接続するクラスをインスタンス化
    $db_connect = new connect();
    // connectクラスの データベースに接続する pdoメソッドにアクセス
    $db_connect = $db_connect -> pdo();
    // 定義したSQL文を prepareメソッドでセット
    $prepare = $db_connect -> prepare($sql);
    // セットしたSQL文の :user_id の値を bindValueメソッドで指定
    $prepare -> bindValue('user_id', $user_id, PDO::PARAM_INT);
    // executeメソッドクエリを実行
    $prepare -> execute();
    // fetch関数で実行結果から1件取得
    $result = $prepare -> fetch();
    // 取得した結果の 第一引数と同名のキーの値を戻り値として返す
    return $result[$item_name];
  } // export_initial_value end
?>