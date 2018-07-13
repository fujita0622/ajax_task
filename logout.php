<?php
  setcookie("login_State", "", time() - 1);
  header('Location:login.php');
?>