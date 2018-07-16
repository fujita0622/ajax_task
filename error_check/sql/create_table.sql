-- データベース作成
CREATE DATABASE health;

-- テーブル作成
CREATE TABLE user_health_info
(
  -- ユーザID 整数型：4桁/自動連番/プライマリキー
  user_id int(4) AUTO_INCREMENT PRIMARY KEY,
  -- 名前 可変長文字列：30文字
  name varchar(30),
  -- 誕生日 日付型
  birthday date,
  -- 身長 整数型：3桁
  height int(3),
  -- 体重 整数型：3桁
  weight int(3),
  -- 喫煙習慣 整数型：1桁
  smoking_habit int(1),
  -- 喫煙習慣 整数型：1桁
  health_symptom varchar(255),
  -- メモ テキスト型
  memo text
  -- 文字コード：UTF-8
)DEFAULT CHARSET = utf8;

-- 練習用ユーザ登録INSERT文
INSERT INTO user_health_info(name,birthday,height,weight,smoking_habit,helth_symptom,memo) VALUES
  ("藤田瞬大朗", "1992-06-22",163,53,1,"頭痛あり","目の疲れが深刻です。");

