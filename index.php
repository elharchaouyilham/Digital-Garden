<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Digital Garden - Accueil</title>
   
</head>
<body>
    <div class="container">
        <h1>Digital Garden</h1>
        <p>Bienvenue dans votre espace personnel d'organisation, d'idées et de croissance numérique.</p>

        <a class="btn" href="register.php">S'inscrire</a>
        <a class="btn" href="login.php">Se connecter</a>
    </div>
</body>
</html>
