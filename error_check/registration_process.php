<?php
  try {
    // エラーが発生したか判断するフラグを定義
    $error_flag = 0;
    // 身長の型判断が行われたか判断するフラグを定義 行われていない:0 行われた:1
    $height_flag = 0;
    // FORMから取得した値が空でないか判断する関数
    function set_var_check($item_name, $var) {
      // FORMから受け取った値が空、もしくは空文字列の場合
      if (isset($var) === false OR $var === "") {
        // "項目名(第一引数)を入力してください"と表示
        // throw new Exception("<p style='color:#ff0000'>{$item_name}を入力してください</p>");
        // TODO:確認用 後に消す
        echo "<p style='color:#ff0000'>{$item_name}を入力してください</p>";
      }
      // 変数を戻り値として返す
      return $var;
    }

    // FORMから取得した値が文字列か判断する関数
    function string_type_check($item_name, $var) {
      // FORMから取得した値が文字列でない場合
      if(!is_string($var)){
        // "項目名(第一引数)は文字列型で入力してください"と表示
        // throw new Exception("<p>{$item_name}は文字列型で入力してください</p>");
        // TODO:確認用 後に消す
        echo "<p>{$item_name}は文字列型で入力してください</p>";
      } // if end 
    } // string_type_check end

    // FORMから取得した値が整数型か判断する関数
    function int_type_check($item_name, $var) {
      // FORMから取得した値が整数型でない場合
      if(!is_int($var)){
        // "項目名(第一引数)は整数型で入力してください"と表示
        // throw new Exception("<p>{$item_name}は整数型で入力してください</p>");
        // TODO:確認用 後に消す
        echo "<p>{$item_name}は整数型で入力してください</p>";
      } // if end 
    } // int_type_check end

    // FORMから取得した値が日付型か判断する関数
    function date_type_check($item_name, $var) {
      // FORMから取得した値が日付型でない場合
      if(!strptime($var, '%Y-%m-%d')){
        // "項目名(第一引数)は日付型で入力してください"と表示
        // throw new Exception("<p>{$item_name}は日付型で入力してください</p>");
        // TODO:確認用 後に消す
        echo "<p>{$item_name}は日付型で入力してください</p>";
      } // if end
      if ($item_name == "身長") {
        $height_flag = 1;
      }
    } // date_type_check end 

    // 身長の範囲を検証する関数
    function height_range($height) {
      // 身長($height)が60以上　250以下ではない場合
      if ($height < 60 OR 250 < $height) {
        // 警告文を表示
        // throw new Exception("<p>身長は60以上、250以下で入力して下さい</p>");
        // TODO:確認用 後に消す
        echo "<p>身長は60以上、250以下で入力して下さい</p>";
      } // if end
    } // height_range end

    // [FORMから値を受け取る]
    // 氏名
    // FORMの値が空でないか検証
    $name = set_var_check("名前", $_POST['name']);
    // 年
    $year = $_POST['year'];
    // 月
    $month = $_POST['month'];
    // 日
    $day = $_POST['day'];
    // DBに列'birthday'に登録する形式に編集
    $birthday = "{$year}{$month}{$day}";
    // date関数で日付型に変換
    $birthday = date('Y-m-d', strtotime($birthday));
    // FORMの値が空でないか検証
    $birthday = set_var_check("誕生日", $birthday);
    // 身長
    // FORMの値が空でないか検証
    $height = set_var_check("身長", $_POST['height']);
    // 整数型に変換
    $height = intval($height);
    // 体重 
    // FORMの値が空でないか検証
    $weight = set_var_check("体重", $_POST['weight']);
    // 整数型に変換
    $weight = intval($weight);
    // 喫煙習慣
    // FORMの値が空でないか検証
    $smoking_habit = set_var_check("喫煙習慣", $_POST['smoking_habit']);
    // 整数型に変換
    $smoking_habit = intval($smoking_habit);
    // 健康の気になる症状
    // FORMの値が空でないか検証
    $health_symptom = set_var_check("健康の気になる症状", $_POST['health_symptom']);
    // メモ
    // FORMの値が空でないか検証
    $memo = set_var_check("メモ", $_POST['memo']);

    // それぞれの型を検証
    string_type_check("名前", $name);
    date_type_check("誕生日", $birthday);
    int_type_check("身長", $height);
    int_type_check("体重", $weight);
    int_type_check("喫煙習慣", $smoking_habit);
    string_type_check("健康の気になる症状", $health_symptom);
    string_type_check("メモ", $memo);

    
    // 身長の型判定が行われたか判断するフラグが1の場合
    if ($height_flag === 1) {
      // height_range関数で体重の制限範囲を検証
      height_range($height);
    }

    // エラーが発生したか判断するフラグの値が0の場合
    if ($error_flag === 0) {
      // TODO:後でクラス化
      // DB接続処理をまとめたファイルを読み込む
      require 'db_connect.php';
      // 更新するSQL文を定義
      // TODO:後でプレースホルダに差し替え
      $sql = "UPDATE user_health_info SET name = '{$name}', birthday = '{$birthday}', height = {$height}, weight = {$weight}, smoking_habit = {$smoking_habit}, health_symptom = '{$health_symptom}', memo = '{$memo}' WHERE user_id = 1";
      // PDOクラスのqueryメソッドで更新するSQL文を実行する
      $query = $db_connect -> query($sql);
      echo "登録完了しました";
    }
  } catch (Exception $e) {
    echo $e -> getmessage();
    // エラーが発生したか判断するフラグに1を代入
    $error_flag = 1;
  }

  // 登録画面を表示
  require_once 'registration.php';
?>