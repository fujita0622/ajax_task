<?php
  // エラーメッセージを代入する変数(配列)を定義
  $error_messages;

  // 各項目のエラーチェック関数を定義
  require_once 'initial_constant.php';

  // 各項目のエラーチェック関数を定義
  require_once 'error_check.php';

  // [FORMから値を受け取る]
  // 氏名
  $name = $_POST['name'];
  $year = $_POST['year'];
  $month = $_POST['month'];
  $day = $_POST['day'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $smoking_habit = $_POST['smoking_habit'];
  $health_symptom = $_POST['health_symptom'];
  $memo = $_POST['memo'];

  // [FORMの値が空でないか検証]
  $error_messages[] = check_set_var("名前", $name);
  $error_messages[] = check_set_var("年", $year);
  $error_messages[] = check_set_var("月", $month);
  $error_messages[] = check_set_var("日", $day);
  $error_messages[] = check_set_var("身長", $height);
  $error_messages[] = check_set_var("体重", $weight);
  $error_messages[] = check_set_var("喫煙習慣", $smoking_habit);
  $error_messages[] = check_set_var("健康の気になる症状", $health_symptom);
  $error_messages[] = check_set_var("メモ", $memo);

  // [列名'birthday'用に年月日を編集]
  // ありえない日付でないか確認
  check_date($month, $day, $year);
  // DBに列'birthday'に登録する形式に編集
  $birthday = "{$year}{$month}{$day}";

  // [型の変換]
  // date関数で日付型に変換
  $birthday = date('Y-m-d', $birthday);
  // 整数型に変換
  $height = intval($height);
  $weight = intval($weight);
  $smoking_habit = intval($smoking_habit);

  // \n ではテキストエリア内では改行されないので改行コード &#13; に置き換え
  $memo = nl2br($memo);
  // $memo = str_replace("\n", "&#13;", $memo);

  // それぞれの型を検証
  $error_messages[] = check_string_type("名前", $name);
  $error_messages[] = check_date_type("誕生日", $birthday);
  $error_messages[] = check_int_type("身長", $height);
  $error_messages[] = check_int_type("体重", $weight);
  $error_messages[] = check_int_type("喫煙習慣", $smoking_habit);
  $error_messages[] = check_string_type("健康の気になる症状", $health_symptom);
  $error_messages[] = check_string_type("メモ", $memo);

  // エラーメッセージは発生した場合
  if(isset($error_messages)) {
    // array_filter関数で null要素を削除
    // array_values関数で配列の添字を振り直す
    $error_messages = array_values(array_filter($error_messages));
    // エラーメッセージが発生した分だけループ処理
    foreach ($error_messages as $value) {
      // エラーメッセージを表示
      echo $value;
    }
  }
  // エラーメッセージは発生しなかった場合
  if (empty($error_messages)) {
    // 更新するSQL文を定義
    $sql = "UPDATE user_health_info SET name = :name, birthday = :birthday, height = :height, weight = :weight,
           smoking_habit = :smoking_habit, health_symptom = :health_symptom, memo = :memo WHERE user_id = {$constant(USER)}";
    // DB接続クラスを読み込み
    $db_connect_class = require_once 'db_connect_class.php';
    // DBに接続するクラスをインスタンス化
    $db_connect = new connect();
    // connectクラスの データベースに接続する pdoメソッドにアクセス
    $db_connect = $db_connect -> pdo();

    $prepare = $db_connect -> prepare($sql);
    // 定義したSQL文を prepareメソッドでセット
    // セットしたSQL文の 各':列名' の値を bindValueメソッドで指定
    $prepare -> bindValue('name', $name, PDO::PARAM_STR);
    $prepare -> bindValue('birthday', $birthday, PDO::PARAM_STR);
    $prepare -> bindValue('height', $height, PDO::PARAM_INT);
    $prepare -> bindValue('weight', $weight, PDO::PARAM_INT);
    $prepare -> bindValue('smoking_habit', $smoking_habit, PDO::PARAM_INT);
    $prepare -> bindValue('health_symptom', $health_symptom, PDO::PARAM_STR);
    $prepare -> bindValue('memo', $memo, PDO::PARAM_STR);
    // executeメソッドクエリを実行
    // クエリが実行された場合
    if($prepare -> execute()) {
      // 登録完了文を表示
      echo "登録完了しました";
    // クエリが実行されない場合
    } else {
      // 登録失敗文を表示
      echo "登録失敗しました";
    }
  }
  // 登録画面を表示
  require_once 'registration.php';
?>