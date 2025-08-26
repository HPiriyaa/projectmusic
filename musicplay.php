<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$songUrl = $_POST['song'] ?? '';
$username = $_SESSION['username'] ?? '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>音楽再生</title>
    <style>

        html, body {
            margin: 0;
            font-family: 'Zen Kaku Gothic New', sans-serif;
            background: url("images/skynsea1.jpg") no-repeat center center fixed;
            background-size: cover;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 25px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 720px;
        }

        iframe, audio {
            width: 100%;
            height: 320px;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .platforms {
            margin-top: 10px;
        }

        .platforms p {
            margin: 5px;
        }

        .favorite-btn {
            background: white;
            color: black;
            transition: 0.2s ease;
            font-size: 16px;
            border-radius: 25px;
            padding: 10px 25px;
            border: 2px solid #ccc;
            cursor: pointer;
        }

        .favorite-btn.clicked {
            background-color: #ffcccc;
            border-color: #ff6666;
            color: red;
        }

        .cloud-button {
            margin-top: 30px;
            background: white;
            padding: 10px 25px;
            border-radius: 30px;
            border: 2px solid #ccc;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            cursor: pointer;
        }

        .cloud-button:hover {
            background-color: #f3f3f3;
        }

        a {
            text-decoration: none;
            font-weight: bold;
            color: #336699;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>あなたの気分は：<?= implode(', ', $_SESSION['mood']) ?></h2>

    <div class="player">
        <?php if (strpos($songUrl, 'youtube.com') !== false): ?>
            <iframe src="<?= str_replace("watch?v=", "embed/", htmlspecialchars($songUrl)) ?>"
                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <?php else: ?>
            <audio controls>
                <source src="<?= htmlspecialchars($songUrl) ?>" type="audio/mp3">
                対応するオーディオプレイヤーが見つかりません。
            </audio>
        <?php endif; ?>
    </div>

    <button class="favorite-btn" id="favBtn">♡ この曲をお気に入りする</button>

    <div class="platforms">
        <p><strong>Platform:</strong></p>
        <p> <a href="https://www.youtube.com/" target="_blank">YouTube</a></p>
        <p> <a href="https://music.apple.com/jp" target="_blank">Apple Music</a></p>
        <p> <a href="https://open.spotify.com/" target="_blank">Spotify</a></p>
    </div>

    <form action="select1.php" method="get" style="display:inline;">
        <button class="cloud-button" type="submit">もう一度しますか？</button>
    </form>

    <form action="main.php" method="post" style="display:inline;">
        <button class="cloud-button" type="submit">メインページ戻る</button>
    </form>
</div>

<script>
    document.getElementById('favBtn').addEventListener('click', function () {
        const button = this;
        fetch("add_favourite.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: "song=<?= urlencode($songUrl) ?>"
        }).then(res => res.text()).then(response => {
            button.classList.add("clicked");
            button.textContent = "♥ お気に入りに追加済み";
        }).catch(err => {
            alert("追加に失敗しました");
        });
    });
</script>
</body>
</html>
