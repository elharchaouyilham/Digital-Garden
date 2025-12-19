<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/config/database.php'; ?>
<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    mysqli_query(
        $conn,
        "INSERT INTO utilisateurs (username, email, password)
         VALUES ('$username', '$email', '$password')"
    );

    header("locaton:dashbord.php");
}
?>


<main class="main">
    <div class="form-container">
        <h2>Créer votre compte</h2>

        <form name="regForm" method="POST" onsubmit="return validateForm();">

            <input class="input-field" type="text" name="username" placeholder="Nom" >
            <span id="error-username"></span>
            <input class="input-field" type="email" name="email" placeholder="Votre email" >
            <span id="error-email"></span>
            <input class="input-field" type="password" name="password" placeholder="Mot de passe" >
            <span id="error-password"></span>
            <button class="btn" type="submit">S'inscrire</button>
        </form>
        <a href="login.php">Déjà inscrit ? Connexion</a>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>