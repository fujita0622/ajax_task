<?php
  // setcookie関数でログイン状況(第一引数)を破棄（第二引数を空文字列/第三引数で過去を指定し破棄）
  setcookie("login_State", "", time() - 1);
  // header関数でログイン画面を指定し遷移
  header('Location:login.php');
?>