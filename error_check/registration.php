<?php 
  // 変数$initial_constantが空の場合
  if(!isset($initial_constant)) {
    // 初期定義定数を読み込み
    require_once 'initial_constant.php';
  }
  // 変数$initial_constantが空の場合
  if (!isset($db_connect_class)) {
    // DBに接続するクラスを読み込み
    require 'db_connect_class.php';
  }

  // 画面表示に関する関数をまとめたファイルを読み込み
  require 'view_function.php';
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
    <!-- export_initial_value関数でDB登録値を初期値に設定 -->
    <p>名前：<input type="text" name="name" value="<?php echo export_initial_value('name' , $constant(USER)); ?>"></p>
    <p>誕生日　年：
      <select name="year">
        <!-- get_birthday_range関数で1950年から2018現在までのオプションタグを表示 -->
        <?php 
          // 誕生日の初期値を関数で取得し '-' 区切りで配列に代入
          $option_initial_value = explode("-", export_initial_value('birthday', USER));
          // セレクトボックスで選択できる年の範囲をget_birthday_range関数で取得
          $option_value = get_birthday_range(LOW_YEAR, date('Y'));
          // 取得した年の範囲分ループ処理
          for ($count=0; $count < count($option_value); $count++) { 
            // 取得した初期値の年数と一致した場合
            if ($option_initial_value[0] == $option_value[$count]) {
              // オプションタグに オプション selected を追加してoptionタグを表示
              echo "<option value='{$option_value[$count]}' selected>{$option_value[$count]}</option>";
            } else {
              // オプションタグを表示
              echo "<option value='{$option_value[$count]}'>{$option_value[$count]}</option>";
            }
          }
         ?>
      </select>
      月：
      <select name="month">
        <!-- get_birthday_range関数で1から12月までのオプションタグを表示 -->
        <?php 
          // セレクトボックスで選択できる月の範囲をget_birthday_range関数で取得
          $option_value = get_birthday_range(1, 12);
          // 取得した月の範囲分ループ処理
          for ($count=0; $count < count($option_value); $count++) { 
            // 取得した初期値の月数と一致した場合
            if ($option_initial_value[1] == $option_value[$count]) {
              // オプションタグに オプション selected を追加してoptionタグを表示
              echo "<option value='{$option_value[$count]}' selected>{$option_value[$count]}</option>";
            } else {
              // オプションタグを表示
              echo "<option value='{$option_value[$count]}'>{$option_value[$count]}</option>";
            }
          }
         ?>
      </select>
      日：
      <select name="day">
        <!-- get_birthday_range関数で1から31日までのオプションタグを表示 -->
        <?php 
          // セレクトボックスで選択できる日の範囲をget_birthday_range関数で取得
          $option_value = get_birthday_range(1, 31);
          // 取得した日の範囲分ループ処理
          for ($count=0; $count < count($option_value); $count++) { 
            // 取得した初期値の日数と一致した場合
            if ($option_initial_value[2] == $option_value[$count]) {
              // オプションタグに オプション selected を追加してoptionタグを表示
              echo "<option value='{$option_value[$count]}' selected>{$option_value[$count]}</option>";
            } else {
              // オプションタグを表示
              echo "<option value='{$option_value[$count]}'>{$option_value[$count]}</option>";
            }
          }
         ?>
      </select>
    </p>
    <!-- export_initial_value関数でDB登録値を初期値に設定 -->
    <!-- min属性に身長の設定できる最小値：60 を指定 -->
    <!-- max属性に身長の設定できる最大値：250 を指定 -->
    <p>身長：<input type="number" name="height" min="<?php echo HEIGHT_MIN; ?>" max="<?php echo HEIGHT_MAX; ?>" value="<?php echo export_initial_value('height', $constant(USER)); ?>"></p>
    <!-- export_initial_value関数でDB登録値を初期値に設定 -->
    <p>体重：<input type="number" name="weight" value="<?php echo export_initial_value('weight', $constant(USER)); ?>"></p>
    <p>喫煙習慣：
    <!-- export_initial_value関数でDB登録値を初期値に設定 -->
    <!-- 取得した値が 0 だった場合 -->
    <?php if(export_initial_value('smoking_habit', $constant(USER)) == 0) : ?>
      <input type="radio" name="smoking_habit" value="0" checked="checked">あり
      <input type="radio" name="smoking_habit" value="1">なし
    <?php else : ?>
      <!-- 取得した値が 0 以外の場合 -->
      <input type="radio" name="smoking_habit" value="0">あり
      <input type="radio" name="smoking_habit" value="1" checked="checked">なし
    <?php endif; ?>
    </p>
    <!-- export_initial_value関数でDB登録値を初期値に設定 -->
    <p>健康の気になる症状：<input type="text" size="75" name="health_symptom" value="<?php echo export_initial_value('health_symptom', $constant(USER)); ?>"></p>
    <p>メモ：
      <!-- export_initial_value関数でDB登録値を初期値に設定 -->
      <textarea cols="50" rows="10" name="memo"><?php echo str_replace("<br />","&#13;" , export_initial_value('memo', $constant(USER))); ?></textarea>
    </p>
    <p><input type="submit" value="登録"></p>
  </form>
</body>
</html>