<?php
session_start();
require 'db.php';

if (!empty($_POST['age'])) {
    $_SESSION['age'] = $_POST['age'];
}

$moods = $_SESSION['mood'] ?? [];
$genre = $_SESSION['genre'] ?? '';
$age_group = $_SESSION['age'] ?? '';

if (empty($moods) || empty($genre) || empty($age_group)) {
    header("Location: select1.php");
    exit();
}

$placeholders = rtrim(str_repeat('?,', count($moods)), ',');
$sql = "SELECT * FROM songs WHERE mood IN ($placeholders) AND genre = ? AND age_group = ? ORDER BY RAND() LIMIT 3";
$stmt = $pdo->prepare($sql);
$stmt->execute([...$moods, $genre, $age_group]);
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>おすすめの音楽</title>
    <style>
        html, body {
            margin: 0;
            font-family: 'Zen Kaku Gothic New', sans-serif;
            background: url("images/skynsea1.jpg") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: #333;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 25px;
            padding: 30px 50px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            max-width: 700px;
            text-align: center;
        }

        .featured-song {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border-radius: 16px;
            margin: 20px 0;
            padding: 15px 20px;
        }

        .featured-song img {
            width: 80px;
            height: 80px;
            border-radius: 12px;
        }

        .song-title {
            flex-grow: 1;
            padding: 0 20px;
            text-align: left;
        }

        .listen-btn {
            background-color: #ffcc66;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .listen-btn:hover {
            background-color: #ffc107;
        }

        .small-song {
            margin: 8px 0;
            text-align: left;
        }

        .cloud-button {
            background: white;
            padding: 10px 25px;
            border-radius: 30px;
            border: 2px solid #ccc;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: 0.2s ease;
        }

        .cloud-button:hover {
            background-color: #f9f9f9;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>あなたの気分は <?= implode(' と ', $_SESSION['mood']) ?> ですね！</h2>
    <p>🎧 おすすめの曲はこちら</p>

    <?php if (count($songs) > 0): ?>
        <?php foreach ($songs as $index => $song): ?>
            <?php if ($index === 0): ?>
                <div class="featured-song">
                    <img src="images/song_thumb.jpg" alt="song">
                    <div class="song-title"><?= htmlspecialchars($song['title']) ?> - <?= htmlspecialchars($song['artist']) ?></div>
                    <form method="post" action="musicplay.php">
                        <input type="hidden" name="song" value="<?= htmlspecialchars($song['file_path']) ?>">
                        <button class="listen-btn" type="submit">聞いてみる</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="small-song"><?= $index + 1 ?>. 🎵 <?= htmlspecialchars($song['title']) ?> - <?= htmlspecialchars($song['artist']) ?></div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>該当するおすすめ曲が見つかりませんでした。</p>
    <?php endif; ?>

    <div class="button-group">
        <form action="select1.php" method="get">
            <button class="cloud-button">もう一度しますか？</button>
        </form>
        <form action="main.php" method="get">
            <button class="cloud-button">メインページへ</button>
        </form>
                <form action="favourite.php" method="get">
            <button class="cloud-button">気に入り</button>
        </form>

    </div>
</div>
</body>
</html>
