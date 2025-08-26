<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get user ID
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch();

$favourites = [];
if ($user) {
    // Join with songs table to get title + artist
    $stmt = $pdo->prepare("
        SELECT f.song_path, s.title, s.artist
        FROM favourites f
        LEFT JOIN songs s ON f.song_path = s.file_path
        WHERE f.user_id = ?
    ");
    $stmt->execute([$user['id']]);
    $favourites = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お気に入り一覧</title>
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

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background: #fff;
            margin: 10px 0;
            padding: 12px 20px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .delete-btn {
            padding: 6px 14px;
            background-color: #ffdddd;
            border: 1px solid #ff9999;
            border-radius: 10px;
            color: #cc0000;
            cursor: pointer;
            font-weight: bold;
        }

        .delete-btn:hover {
            background-color: #ffcccc;
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

    </style>
</head>
<body>
<div class="container">
    <h2>お気に入り一覧</h2>

    <?php if (count($favourites) > 0): ?>
        <ul>
            <?php foreach ($favourites as $fav): ?>
                <li>
                    <?= htmlspecialchars($fav['title'] ?? '（曲名なし）') ?> - <?= htmlspecialchars($fav['artist'] ?? '') ?>
                    <a class="delete-btn" href="delete_favourite.php?song=<?= urlencode($fav['song_path']) ?>">削除</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>お気に入りがありません。</p>
    <?php endif; ?>

    <a class="cloud-button" href="main.php">メインページに戻る</a>
</div>
</body>
</html>
