<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>気分に寄り添う音楽</title>
    <style>

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Zen Kaku Gothic New', sans-serif;
            background: url("images/sunnyday1.jpg") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #333;
        }

        .container {
            padding: 0 20px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
        }

        .subtitle {
            margin-top: 10px;
            font-size: 16px;
        }

        .start-button {
            margin: 25px auto;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            background-color: #ffffffcc;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }

        .start-button:hover {
            background-color: #fff;
            transform: scale(1.05);
        }

        .cloud-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
            gap: 30px;
        }

        .cloud {
            background: #ffffffdd;
            padding: 20px 30px;
            border-radius: 40px;
            box-shadow: 2px 4px 10px rgba(0,0,0,0.1);
            min-width: 200px;
        }

        .cloud h3 {
            font-size: 16px;
            margin-bottom: 12px;
        }

        .cloud a {
            text-decoration: none;
            font-weight: bold;
            color: #2a78c4;
            margin: 0 10px;
            padding: 8px 16px;
            background-color: #e0f0ff;
            border-radius: 8px;
            transition: 0.2s ease;
        }

        .cloud a:hover {
            background-color: #c9e6ff;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">気分に寄り添う音楽レコメンド</div>
        <div class="subtitle">あなたの気分はどの曲でしょう？</div>

        <form action="select1.php" method="get">
            <button class="start-button">START！</button>
        </form>

        <div class="cloud-container">
            <div class="cloud">
                <h3>アカウントをお持ちしますか？</h3>
                <a href="login.php">LOG IN</a>
                <a href="signup.php">SIGN UP</a>
            </div>

            <div class="cloud">
                <h3>他の曲</h3>
                <a href="recommendation.php">おすすめ</a>
                <a href="favourite.php">お気に入り</a>
            </div>
        </div>

        <div class="footer">&copy; 2025 MoodMusic recommendation Project Group2</div>
    </div>
</body>
</html>
