<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$genre = $_SESSION['genre'] ?? 'pop';

$stmt = $pdo->prepare("SELECT title, artist, file_path FROM songs WHERE genre = ? ORDER BY RAND() LIMIT 3");
$stmt->execute([$genre]);
$recommendations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>おすすめ</title>
    <style>

        html, body {
            margin: 0;
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
            padding: 30px 50px;
            border-radius: 20px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 700px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .song-item {
            background: #fff;
            margin: 10px 0;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .play-form {
            display: inline;
        }

        .play-btn {
            background-color: #ffcc66;
            padding: 6px 14px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .play-btn:hover {
            background-color: #ffc107;
        }

        .cloud-button {
            margin-top: 30px;
            background: white;
            padding: 10px 25px;
            border-radius: 30px;
            border: 2px solid #ccc;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-decoration: none;
            color: #333;
        }

        .cloud-button:hover {
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>あなたへのおすすめ（ジャンル: <?= htmlspecialchars($genre) ?>）</h2>

    <?php if (count($recommendations) > 0): ?>
        <?php foreach ($recommendations as $song): ?>
            <div class="song-item">
                <?= htmlspecialchars($song['title']) ?> - <?= htmlspecialchars($song['artist']) ?>
                <form class="play-form" method="post" action="musicplay.php">
                    <input type="hidden" name="song" value="<?= htmlspecialchars($song['file_path']) ?>">
                    <button class="play-btn" type="submit">聞いてみる</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>おすすめ曲が見つかりませんでした。</p>
    <?php endif; ?>

    <a class="cloud-button" href="main.php">メインページへ</a>
</div>
</body>
</html>
