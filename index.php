<?php
session_start();

// Si un utilisateur est connecté, on redirige vers le dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Garden - Accueil</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #e9f2ea;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: white;
            padding: 15px 20px;
            border-bottom: 1px solid #ccc;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            color: #2e5532;
        }

        .container {
            padding: 40px 20px;
            text-align: center;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            color: #2e5532;
        }

        .subtitle {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }

        .buttons {
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin: 0 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-register {
            background-color: #3fa35b;
            color: white;
        }

        .btn-register:hover {
            background-color: #308347;
        }

        .btn-login {
            background-color: #2e74d1;
            color: white;
        }

        .btn-login:hover {
            background-color: #1f5cad;
        }

        footer {
            margin-top: 50px;
            padding: 15px;
            text-align: center;
            color: #666;
        }
    </style>
</head>

<body>

<header>
    <h1>🌿 Digital Garden</h1>
</header>

<div class="container">
    <div class="title">Bienvenue dans Digital Garden</div>
    <div class="subtitle">Organisez vos idées, notes et projets dans un espace privé.</div>

    <div class="buttons">
        <a href="register.php" class="btn btn-register">S'inscrire</a>
        <a href="login.php" class="btn btn-login">Se connecter</a>
    </div>
</div>

<footer>
    © 2025 Digital Garden — GreenTech Solutions
</footer>

</body>
</html>
