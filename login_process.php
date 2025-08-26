<?php
require 'db.php';
session_start();

$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['username'];
    header("Location: main.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン失敗</title>
    <style>

        html, body {
            margin: 0;
            padding: 0;
            font-family: 'Zen Kaku Gothic New', sans-serif;
            background: url("images/sunrise1.jpg") no-repeat center center fixed;
            background-size: cover;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            max-width: 500px;
        }

        .error {
            font-size: 20px;
            color: red;
            margin-bottom: 20px;
        }

        .back-button {
            padding: 10px 25px;
            border-radius: 30px;
            background: white;
            border: 2px solid #ccc;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            cursor: pointer;
            text-decoration: none;
            color: #333;
        }

        .back-button:hover {
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="error">ログイン失敗：メールアドレスまたはパスワードが正しくありません。</div>
    <a class="back-button" href="login.php">ログインページに戻る</a>
</div>
</body>
</html>
