<?php
// include '../partials/header.php'; 
?>

<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="auth-page">
    <h1>Inscription</h1>
    <form method="POST">
        <label>Pseudo</label><br>
        <input type="text" name="username" required><br>

        <label>Email</label><br>
        <input type="email" name="email" required><br>

        <label>Mot de passe</label><br>
        <input type="password" name="password" required><br>

        <button type="submit">S'inscrire</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <p><a href="index.php?page=login">Déjà inscrit ? Connecte toi</a></p>
</main>

<?php
// include '../partials/footer.php'; 
?>

<?php include __DIR__ . '/../partials/footer.php'; ?>