<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>     
</head>

<body>

<div class="container">

    <h2>Bienvenue, <?php echo htmlspecialchars($username); ?> </h2>

    <div class="info">
        <p><strong>Date d'inscription :</strong> <?php echo $created_at; ?></p>
        <p><strong>Heure de connexion :</strong> <?php echo $login_time; ?></p>
    </div>

    <a class="btn" href="themes.php">Gérer mes Thèmes</a>
    <a class="btn" href="notes.php">Gérer mes Notes</a>
    <a class="btn logout" href="logout.php">Déconnexion</a>

</div>

</body>
</html>