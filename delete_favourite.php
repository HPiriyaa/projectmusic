<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username']) || !isset($_GET['song'])) {
    header("Location: login.php");
    exit();
}

$song = $_GET['song'];

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch();

if ($user) {
    $stmt = $pdo->prepare("DELETE FROM favourites WHERE user_id = ? AND song_path = ?");
    $stmt->execute([$user['id'], $song]);
}

header("Location: favourite.php");
exit();
