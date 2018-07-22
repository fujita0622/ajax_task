<?php
  /* 
   * FORMから取得した値が空でないか判断する関数
   * @param item_name FORMの項目名
   * @param var FORMから値を受け取る変数
   * @return エラーメッセージ
  */
  function check_set_var($item_name, $var) {
    // FORMから受け取った値が空、もしくは空文字列の場合
    if (isset($var) === false OR $var === "") {
      // エラーメッセージを戻り値として返す
      return "<p style='color:#ff0000'>{$item_name}を入力してください</p>";
    }
  }

  /* 
   * FORMから取得した値が文字列か判断する関数
   * @param item_name FORMの項目名
   * @param var FORMから値を受け取る変数
   * @return エラーメッセージ
  */
  function check_string_type($item_name, $var) {
    // FORMから取得した値が文字列でない場合
    if(!is_string($var)){
      // エラーメッセージを戻り値として返す
      return "<p>{$item_name}は文字列型で入力してください</p>";
    } // if end 
  } // check_string_type end

  /* 
   * FORMから取得した値が整数型か判断する関数
   * @param item_name FORMの項目名
   * @param var FORMから値を受け取る変数
   * @return エラーメッセージ
  */
  function check_int_type($item_name, $var) {
    // FORMから取得した値が整数型でない場合
    if(!is_int($var)){
      // エラーメッセージを戻り値として返す
      return "<p>{$item_name}は整数型で入力してください</p>";
    // FORMから取得した値が整数型の場合
    } else {
      // and一致
      // 第一引数の値が'身長'
      // 第二引数が空ではない
      // or一致
      // 第二引数が60未満
      // 第二引数が250以上
      if($item_name == "身長" AND empty($var) == false AND $var < HEIGHT_MIN OR HEIGHT_MAX < $var) {
        // エラーメッセージを戻り値として返す
        return "<p>身長は60以上、250以下で入力して下さい</p>";
      }
    } // if end 
  } // check_int_type end

  /* 
   * FORMから取得した値が日付型か判断する関数
   * @param item_name FORMの項目名
   * @param var FORMから値を受け取る変数
   * @return エラーメッセージ
  */
  function check_date_type($item_name, $var) {
    // FORMから取得した値が日付型でない場合
    // 'xxxx-xx-xx' のパターンを変数に代入
    $pattern = "/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/";
    // 第二引数の値が 'xxxx-xx-xx' 形式じゃない場合
    if(!preg_match($pattern, $var)){
      // エラーメッセージを戻り値として返す
      return "<p>{$item_name}は日付型で入力してください</p>";
    } // if end
  } // check_date_type end 

  /* 
   * FORMから取得した値が日付型か判断する関数
   * @param month 月
   * @param day 日
   * @param year 年
   * @return エラーメッセージ
  */
  function check_date($month, $day, $year) {
    // checkdate関数で日付の妥当性を確認
    // ありえない日付の場合
    if(!checkdate($month, $day, $year)){
      // エラーメッセージを戻り値として返す
      return "<p>曜日が存在しません</p>";
    } // if end
  } // check_date end 
?>