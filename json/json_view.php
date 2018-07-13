<!DOCTYPE html>
<html lang="ja">
<head>
  <title>JSON演習問題</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(function() {
      // 
      $('json_btn').click(
        $.ajax({
          type: 'POST',
          url: 'json/practice.json',
          dataType: 'json',
          success: function(json){
            var len = json.length;
            for(var index=0; index < len; index++){
              $("#json_btn").append(json[index].version + ' ' + json[index].codename + '<br>');
            }
          }
        }); // success: end
      });
    }); // $(function()
  </script>
</head>
<body>
  <button id="json_btn">データ取得</button>
</body>
</html>