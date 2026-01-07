<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: white;
        }

        .login-box {
            text-align: center;
            width: 400px;
        }

        .welcome-text {
            color: #f97316;
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .sub-text {
            color: #2563eb;
            font-size: 16px;
            margin-bottom: 40px;
        }

        .input-login {
            width: 100%;
            padding: 15px;
            background: #eeeeee;
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
            outline: none;
            box-sizing: border-box;
        }

        .btn-login {
            background: #f97316;
            color: white;
            border: none;
            width: 120px;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h1 class="welcome-text">Selamat Datang</h1>
        <p class="sub-text">Masuk untuk mengakses aplikasi!</p>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="text" name="username" class="input-login" placeholder="Masukkan username">
            <input type="password" name="password" class="input-login" placeholder="Masukkan password">
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>

</html>
