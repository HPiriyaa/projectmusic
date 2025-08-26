<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>気分を選んでください</title>
    <style>

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Zen Kaku Gothic New', sans-serif;
            background: url("images/sunrise1.jpg") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #333;
        }

        .container {
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 800px;
        }

        h2 {
            margin-bottom: 25px;
            font-size: 28px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .mood-option {
            position: relative;
            cursor: pointer;
            border-radius: 20px;
            transition: transform 0.2s;
        }

        .mood-option:hover {
            transform: scale(1.05);
        }

        .mood-option input[type="radio"] {
            display: none;
        }

        .mood-option img {
            width: 120px;
            height: 120px;
            border: 4px solid transparent;
            border-radius: 16px;
        }

        .mood-option input[type="radio"]:checked + img {
            border: 6px solid #ffffff;
            box-shadow: 0 0 25px 8px #ffffffcc;
            transform: scale(1.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .submit-btn {
            margin-top: 30px;
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
        <h2>あなたの気分は？</h2>
        <form action="select.php" method="post">
            <?php
            $moods = [
                "喜び" => "happy.jpeg",
                "悲しみ" => "sad.jpeg",
                "安心" => "relief.jpeg",
                "楽しい" => "fun.jpeg",
                "不安" => "anxious.jpeg",
                "驚き" => "surprised.jpeg",
                "平静" => "calm.jpeg",
                "退屈" => "bored.jpeg",
                "怒り" => "angry.jpeg"
            ];
            foreach ($moods as $label => $file) {
                echo '
                <label class="mood-option">
                    <input type="radio" name="mood[]" value="'.htmlspecialchars($label).'">
                    <img src="images/'.$file.'" alt="'.$label.'">
                    <div>'.$label.'</div>
                </label>';
            }
            ?>
            <div style="width: 100%; text-align: center;">
                <input class="submit-btn" type="submit" value="次へ">
            </div>
        </form>
    </div>
</body>
</html>



