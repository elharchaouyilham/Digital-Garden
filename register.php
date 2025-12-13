<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>

</head>

<body>

<div class="form-container">
    <h2>Créer votre compte</h2>

    <form name="regForm" method="POST" onsubmit="return validateForm();">

        <input class="input-field" type="text" name="username"
               placeholder="Nom d'utilisateur" required>

        <input class="input-field" type="password" name="password"
               placeholder="Mot de passe" required>

        <input class="input-field" type="password" name="confirm"
               placeholder="Confirmer le mot de passe" required>

        <button class="btn" type="submit">S'inscrire</button>
    </form>
</div>

</body>
<script src="script/script.js"></script>
</html>
