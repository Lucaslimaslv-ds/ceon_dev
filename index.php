<?php
session_start();

require_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEON - Plataforma Escolar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 8px;
            border: 1px solid #333;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #cccccc;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            background-color: #2c2c2c;
            border: 1px solid #444;
            border-radius: 4px;
            color: #ffffff;
            font-size: 16px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ffffff;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: #ffffff;
            color: #000000;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>CEON</h1>
        
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="email">E-mail de acesso</label>
                <input type="email" id="email" name="email" required placeholder="Digite seu e-mail">
            </div>
            
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required placeholder="Digite sua senha">
            </div>
            
            <button type="submit" class="btn-login">Entrar no Sistema</button>
        </form>
    </div>

</body>
</html>