<?php include __DIR__. '/includes/header.php'; ?>
<main class="main">
<div class="form-container">
    <h2>Connexion</h2>

    <form>
          <label>Nom d'utilisateur</label>
        <input class="input-field" type="text" name="username" placeholder="Nom d'utilisateur" required>
  <label>Votre mot de passe </label>
        <input class="input-field" type="password" name="password" placeholder="Mot de passe" required>

        <button class="btn" type="submit">Se connecter</button>
    </form>
</div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
