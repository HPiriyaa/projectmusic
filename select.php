<?php 
session_start();
$_SESSION['mood'] = $_POST['mood'] ?? '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ジャンル選択</title>
    <style>
        body {
            background: url("images/sunnyday1.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: 'Zen Kaku Gothic New', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            padding: 40px 50px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.4);
        }

        input[type="radio"] {
            display: none;
        }

        label img {
            width: 140px;
            height: 140px;
            border-radius: 12px;
            cursor: pointer;
            opacity: 0.85;
            transition: 0.3s;
            border: 3px solid transparent;
        }

        input[type="radio"]:checked + label img {
            width: 165px;
            height: 165px;
            opacity: 1;
            outline: 4px solid #fff;
            box-shadow: 0 0 15px #ffffffaa;
        }

        .genre-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            margin-bottom: 30px;
        }

        .genre-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .genre-item div {
            margin-top: 8px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
        }

        .submit-btn {
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            background-color: #ffffffcc;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .submit-btn:hover {
            background-color: #fff;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>ジャンルを選んでください</h1>

    <form method="POST" action="select2.php">
        <div class="genre-options">
            <?php
            $genres = [
                "rock"       => "rock2.PNG",
                "pop"        => "pop2.PNG",
                "r&b"        => "rnb2.PNG",
                "electronic" => "electronic2.PNG",
                "hip-hop"    => "hiphop2.PNG"
            ];
            foreach ($genres as $value => $img) {
                $id = md5($value);
                echo '
                    <div class="genre-item">
                        <input type="radio" id="'.$id.'" name="genre" value="'.htmlspecialchars($value).'">
                        <label for="'.$id.'">
                            <img src="images/'.$img.'" alt="'.$value.'">
                        </label>
                        <div>'.htmlspecialchars(strtoupper($value)).'</div>
                    </div>
                ';
            }
            ?>
        </div>
        <input type="submit" class="submit-btn" value="次へ">
    </form>
</div>

</body>
</html>










