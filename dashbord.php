<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/config/database.php'; ?>
<div class="container">
    <?php
    session_start(); ?>

    <h2>Bienvenue, <?php echo $_SESSION["user"]; ?> </h2>

    <div class="info">
        <p><strong>Date d'inscription :</strong> </p>
        <!-- <?php echo $created_at; ?> -->
        <p><strong>Heure de connexion :</strong></p>
        <!-- <?php echo $login_time; ?> -->

    </div>

    <a class="btn" href="themes.php">Gérer mes Thèmes</a>
    <a class="btn" href="notes.php">Gérer mes Notes</a>
    <a class="btn logout" href="logout.php">Déconnexion</a>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>