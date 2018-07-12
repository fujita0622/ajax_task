-- データベースの作成 -- 
CREATE DATABASE ajax_task;

-- テーブルの作成 -- 
CREATE TABLE user_info(
  -- ユーザID 整数型(4桁) 連番,主キー指定 --
  user_id int(4) AUTO_INCREMENT PRIMARY KEY,
  -- ログインID 可変長文字列型(30バイト)--
  login_id varchar(30),
  -- ログインパスワード 可変長文字列型(8バイト) --
  login_password varchar(8),
  -- ユーザ氏名 可変長文字列型(50バイト) --
  user_name varchar(50)
);

-- ログイン情報登録 --
INSERT INTO user_info(login_id,login_password,user_name) VALUES
  ("fujita1234", 1234, "藤田瞬大朗"),
  ("yamada5678", 5678, "山田大朗"),
  ("sato4321", 4321, "佐藤瞬"),
  ("shibasaki8765", 8765, "柴崎和夫");


