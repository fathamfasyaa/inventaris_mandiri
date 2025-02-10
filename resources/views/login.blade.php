<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #2b5876, #4e4376);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.15);
            padding: 40px;
            border-radius: 15px;
            backdrop-filter: blur(15px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            color: white;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        h1 {
            margin-bottom: 20px;
            font-weight: 600;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            text-align: left;
            font-weight: 300;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.3);
            color: white;
            outline: none;
            font-size: 16px;
            transition: all 0.3s;
        }

        input:focus {
            background: rgba(255, 255, 255, 0.5);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #ff7eb3;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            color: white;
            font-weight: bold;
            transition: all 0.3s;
        }

        button:hover {
            background: #ff4f8b;
            transform: scale(1.05);
        }

        .error-message {
            background: rgba(255, 0, 0, 0.3);
            color: white;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/login" method="POST">
            @csrf
            <label for="user_nama">Username:</label>
            <input type="text" name="user_nama" id="user_nama" placeholder="Enter your username" required>
            <label for="user_pass">Password:</label>
            <input type="password" name="user_pass" id="user_pass" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
