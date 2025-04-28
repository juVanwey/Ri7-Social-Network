<?php
// include '../partials/header.php'; 
?>

<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="auth-page">
    <h1>Connexion</h1>
    <form method="POST" action="index.php?page=login">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Se connecter</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <p><a href="index.php?page=register">Pas encore inscrit ? Crée un compte</a></p>
</main>

<?php
// include '../partials/footer.php'; 
?>

<?php include __DIR__ . '/../partials/footer.php'; ?>