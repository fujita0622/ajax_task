<?php 
  // 初期処理定数
  // ※練習用user_id
  const USER = 1;
  // 身長の設定できる最小値
  const HEIGHT_MIN = 60;
  // 身長の設定できる最大値
  const HEIGHT_MAX = 250;

  // 誕生日のオプションタグを選択範囲分ループ処理して表示する関数
  function birthday_option_range($first, $last) {
    // 初期値にオプションタグの最初の値($first)を指定
    // オプションタグの最初の値($last)でループを終了
    for ($count = $first; $count <= $last; $count++) { 
      // オプションタグの値が1桁の場合
      if (strlen($count) === 1) {
        // str_pad関数で左に0埋めで2桁に整形
        $count = str_pad($count, 2, 0, STR_PAD_LEFT);
      } // if end
      // オプションタグを表示
      echo "<option value='{$count}'>{$count}</option>";
    } // for end
  } // birthday_option_range end

  // DBからFORMの各項目の初期値を取得する関数
  function form_initial_value($item_name) {
    // TODO:後でクラス化
    // DB接続処理をまとめたファイルを読み込む
    require 'db_connect.php';
    // TODO:後でプレースホルダに差し替え
    // 引数に指定したカラムを取得するSQL文を定義
    $sql = "SELECT {$item_name} FROM user_health_info WHERE user_id = 1";
    // PDOクラスのqueryメソッドでSQL文を実行
    $query = $db_connect -> query($sql);
    // PDOクラスのfetch関数で指定したカラムを取得
    $result = $query -> fetch();
    // 取得したカラムを戻り値として返す
    return $result[$item_name];
  } // form_initial_value end 
?>
<!DOCTYPE html>
<!-- 言語：日本語 -->
<html lang="ja">
<head>
  <title>健康状態登録画面</title>
  <!-- 文字コード：UTF-8 -->
  <meta charset="utf-8">
</head>
<body>
  <!-- 送信先：registration_process.php HTTPメソッド:POST-->
  <form action="registration_process.php" method="POST">
    <!-- form_initial_value関数でDB登録値を初期値に設定 -->
    <p>名前：<input type="text" name="name" value="<?php echo form_initial_value('name'); ?>"></p>
    <p>誕生日　年：
      <select name="year">
        <!-- birthday_option_range関数で1950年から2018現在までのオプションタグを表示 -->
        <?php birthday_option_range(1950, date('Y')); ?>
      </select>
      月：
      <select name="month">
        <!-- birthday_option_range関数で1から12月までのオプションタグを表示 -->
        <?php birthday_option_range(1, 12); ?>

      </select>
      日：
      <select name="day">
        <!-- birthday_option_range関数で1から31日までのオプションタグを表示 -->
        <?php birthday_option_range(1, 31); ?>
      </select>
    </p>
    <!-- form_initial_value関数でDB登録値を初期値に設定 -->
    <!-- min属性に身長の設定できる最小値：60 を指定 -->
    <!-- max属性に身長の設定できる最大値：250 を指定 -->
    <p>身長：<input type="number" name="height" min="<?php echo HEIGHT_MIN; ?>" max="<?php echo HEIGHT_MAX; ?>" value="<?php echo form_initial_value('height'); ?>"></p>
    <!-- form_initial_value関数でDB登録値を初期値に設定 -->
    <p>体重：<input type="number" name="weight" value="<?php echo form_initial_value('weight'); ?>"></p>
    <p>喫煙習慣：
    <?php if(form_initial_value('smoking_habit') == 0) : ?>
      <input type="radio" name="smoking_habit" value="0" checked="checked">あり
      <input type="radio" name="smoking_habit" value="1">なし
    <?php else : ?>
      <input type="radio" name="smoking_habit" value="0">あり
      <input type="radio" name="smoking_habit" value="1" checked="checked">なし
    <?php endif; ?>
    </p>
    <!-- form_initial_value関数でDB登録値を初期値に設定 -->
    <p>健康の気になる症状：<input type="text" size="75" name="health_symptom" value="<?php echo form_initial_value('health_symptom'); ?>"></p>
    <p>メモ：
      <!-- form_initial_value関数でDB登録値を初期値に設定 -->
      <textarea cols="50" rows="10" name="memo"><?php echo form_initial_value('memo'); ?></textarea>
    </p>
    <p><input type="submit" value="登録"></p>
  </form>
</body>
</html>