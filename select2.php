<?php 
session_start();
$_SESSION['genre'] = $_POST['genre'] ?? '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>年齢選択</title>
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

        .age-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            margin-bottom: 30px;
        }

        .ageimg {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .ageimg div {
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
    <h1>年齢を選んでください</h1>

    <form action="result.php" method="post">
        <div class="age-options">
            <?php
            $ages = [
                "10~20代"   => "10-20.PNG",
                "30~40代"   => "30-40.PNG",
                "50~60代"   => "50-60.PNG",
                "70代以上"  => "70up.PNG"
            ];
            foreach ($ages as $label => $img) {
                $id = md5($label);
                echo '
                    <div class="ageimg">
                        <input type="radio" id="'.$id.'" name="age" value="'.htmlspecialchars($label).'">
                        <label for="'.$id.'">
                            <img src="images/'.$img.'" alt="'.$label.'">
                        </label>
                        <div>'.$label.'</div>
                    </div>
                ';
            }
            ?>
        </div>
        <input class="submit-btn" type="submit" value="完了">
    </form>
</div>

</body>
</html>

