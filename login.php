<!DOCTYPE html>
<html lang="ja">
<head><meta charset="UTF-8"><title>ログイン</title>
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
        padding: 30px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    h2 {
        margin-bottom: 20px;
    }

    form {
        margin-top: 15px;
    }

    input[type="email"],
    input[type="password"] {
        padding: 10px;
        margin: 10px 0;
        border: none;
        border-radius: 8px;
        width: 240px;
    }

    button {
        padding: 10px 25px;
        font-weight: bold;
        background-color: #ffffffcc;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.2s ease;
        margin: 5px;
    }

    button:hover {
        background-color: #fff;
        transform: scale(1.05);
    }
</style>
</head>
<body>
<div class="container">
    <h2>ログインアカウント</h2>
    <form method="POST" action="login_process.php">
        <input type="email" name="email" placeholder="メールアドレス" required><br>
        <input type="password" name="password" placeholder="パスワード" required><br>
        <button type="submit">LOGIN</button>
    </form>
    <a href="signup.php"><button>SIGNUP</button></a>
</div>
</body>
</html>