<?php
include __DIR__ . '/includes/header.php';
include __DIR__ . '/config/database.php';
if ($_POST) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM utilisateurs WHERE email='$email'"
    );

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["username"];
            header("Location: dashbord.php");
            exit;
        }
    }

    echo "Email ou mot de passe incorrect";
}
?>

<main class="main">
    <div class="form-container">
        <h2>Connexion</h2>

        <form method="post">
            <label>Votre email</label>
            <input class="input-field" type="email" name="email" placeholder="Votre email" required>

            <label>Votre mot de passe</label>
            <input class="input-field" type="password" name="password" placeholder="Mot de passe" required>

            <button class="btn" type="submit">Se connecter</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>