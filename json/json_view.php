<!DOCTYPE html>
<html lang="ja">
<head>
  <title>JSON演習問題</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(function() {
      // データ取得ボタン押下時にjsonファイルを読み込み表示する処理をclick関数内に記述
      $('#json_btn').on('click',function(){
        // $.ajaxメソッド内にjson取得するための情報を記述
        $.ajax({
          // HTTPメソッド:POST
          type: 'POST',
          // 読み込みファイルのパス：json/practice.json
          url: 'json/practice.json',
          // データの種類：jsonファイル
          dataType: 'json',
          // 取得に成功した場合
          success: function(json){
            // $.eachメソッドでjsonファイルから要素数分ループ処理
            // function内の j_indexはjsonから取得するkey, j_valueは取得する値が入る
            $.each(json, function(j_index, j_value) {
              // 値が配列型の場合
              if (typeof(j_value) == 'object') {
                // function内の v_indexはjsonから取得するkey, v_valueは取得する値が入る
                $.each(j_value, function(v_index, v_value) {
                // 配列型表示用のdivタグ(#result)にappend関数で(jsonファイルで取得したkey:jsonファイルで取得した値)の形式で表示
                  $('#array_result').append(j_index + '：' + v_index + '：' + v_value + '<br>');
                });
              // 値が配列型ではない場合
              } else {
                // 配列型以外を表示するdivタグ(#result)にappend関数で(jsonファイルで取得したkey:jsonファイルで取得した値)の形式で表示
                $('#result').append(j_index + '：' + j_value + '<br>');
              }
            });
          }, // success: end
          // 取得が失敗した場合
          error: function(json){
            // アラートを画面に表示
            alert('error');
          } // error: end
        }) // $.ajax end
      }); // on.click end
    }); // $(function()
  </script>
</head>
<body>
  <button id="json_btn">データ取得</button>
  <p style="color:#ff0000;">配列型の出力</p>
  <div id="array_result"></div>
  <p style="color:#0000ff;">配列型以外の出力</p>
  <div id="result"></div>
</body>
</html>