-- 初回のパスワードポリシーを満たすパスワードを設定（適当でよい）
SET password FOR root@localhost=password('MySQL_abcdefg1234567@DB');

-- パスワードポリシーの変更
SET global validate_password_policy=LOW;
-- パスワードの変更
SET password FOR root@localhost=password('password');

-- 権限の付与（IPアドレスによるアクセス元の制限は指定しない）
GRANT ALL ON *.* TO 'root'@'%' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;