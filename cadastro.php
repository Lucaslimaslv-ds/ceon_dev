<?php
session_start();
require_once 'conexao.php';

$mensagem = '';
$tipo_mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $tipo_usuario = $_POST['tipo_usuario'] ?? '';

    $tipos_validos = ['aluno', 'professor', 'admin'];

    if (!empty($nome) && !empty($email) && !empty($senha) && in_array($tipo_usuario, $tipos_validos)) {        
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES (:nome, :email, :senha, :tipo_usuario)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $senha_hash);
            $stmt->bindValue(':tipo_usuario', $tipo_usuario);

            if ($stmt->execute()) {
                $mensagem = "Usuário cadastrado com sucesso!";
                $tipo_mensagem = "sucesso";
            }
        } catch (PDOException $e) {
            $mensagem = "Erro no banco de dados: " . $e->getMessage();
            $tipo_mensagem = "erro";
        }
    } else {
        $mensagem = "Preencha todos os campos corretamente.";
        $tipo_mensagem = "erro";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEON - Cadastro de Usuário</title>
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
            min-height: 100vh;
            padding: 20px;
        }

        .cadastro-container {
            background-color: #1e1e1e;
            padding: 40px;
            border-radius: 8px;
            border: 1px solid #333;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .cadastro-container h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .alert.sucesso {
            background-color: #1b4332;
            color: #d8f3dc;
            border: 1px solid #2d6a4f;
        }

        .alert.erro {
            background-color: #49111c;
            color: #ffccd5;
            border: 1px solid #800f2f;
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

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 12px;
            background-color: #2c2c2c;
            border: 1px solid #444;
            border-radius: 4px;
            color: #ffffff;
            font-size: 16px;
        }

        .form-group input:focus, 
        .form-group select:focus {
            outline: none;
            border-color: #ffffff;
        }

        .btn-cadastro {
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
            margin-top: 10px;
        }

        .btn-cadastro:hover {
            background-color: #e0e0e0;
        }

        .link-login {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #aaaaaa;
            text-decoration: none;
            font-size: 14px;
        }

        .link-login:hover {
            color: #ffffff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="cadastro-container">
        <h1>Criar Conta no CEON</h1>

        <?php if (!empty($mensagem)): ?>
            <div class="alert <?= $tipo_mensagem ?>">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>
        
        <form action="cadastro.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required placeholder="Ex: Maria Silva">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required placeholder="Ex: maria@ceon.com">
            </div>
            
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required placeholder="Crie uma senha segura">
            </div>

            <div class="form-group">
                <label for="tipo_usuario">Tipo de Usuário</label>
                <select id="tipo_usuario" name="tipo_usuario" required>
                    <option value="" disabled selected>Selecione o tipo...</option>
                    <option value="aluno">Aluno</option>
                    <option value="professor">Professor</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            
            <button type="submit" class="btn-cadastro">Cadastrar</button>
        </form>

        <a href="index.php" class="link-login">Já tem uma conta? Faça login aqui</a>
    </div>

</body>
</html>