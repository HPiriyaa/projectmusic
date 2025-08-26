<?php
session_start();
require 'db.php';

if (isset($_POST['song']) && isset($_SESSION['username'])) {
    $song = $_POST['song'];

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch();

    if ($user) {
        $check = $pdo->prepare("SELECT * FROM favourites WHERE user_id = ? AND song_path = ?");
        $check->execute([$user['id'], $song]);

        if ($check->rowCount() === 0) {
            $stmt = $pdo->prepare("INSERT INTO favourites (user_id, song_path) VALUES (?, ?)");
            $stmt->execute([$user['id'], $song]);
            echo "お気に入りに追加しました！<br>";
        } else {
            echo "すでにお気に入りに追加されています。<br>";
        }
    }
}
echo '<a href="favourite.php">お気に入りを見る</a>';
