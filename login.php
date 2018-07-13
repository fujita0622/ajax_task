<?php if (isset($_COOKIE['login_State'])) : ?>
  <p><?php echo $_COOKIE['login_State']; ?>様、ログイン済み</p>
  <button type="button" onclick="location.href='logout.php'">ログアウト</button>
  <?php exit; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>ログイン画面</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<form method="post" accept-charset="utf-8">
  ID：<input type="text" name="login_id" id="login_id">
  パスワード：<input type="text" name="login_password" id="login_password">
</form>
  <button id="ajax">ログイン</button>
  <div class="result"></div>
</body>
</html>
<script type="text/javascript">
  $(function(){
    // ログインボタン(#ajax)を押した時に実行する関数を定義
    $('#ajax').on('click',function(){
      // Ajax通信を$.ajaxメソッド内に定義
      $.ajax({
        // アクセス先のパス：login_check.php
        url:'./login_check.php',
        // 通信に利用するHTTPメソッド：POST
        type:'POST',
        // 送信するデータ
        data:{ 
          'login_id':$('#login_id').val(),
          'login_password':$('#login_password').val()
        }
      })
      // Ajaxリクエストが成功した時発動
      .done(function (data) {
        $('.result').html(data);
      })
      // Ajaxリクエストが失敗した時発動
      .fail(function (data) {
        $('.result').html(data);
      })

    }); // 
  });
 </script>