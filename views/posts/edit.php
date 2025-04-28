<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="edit-post-page">
    <h1>Modifier le post</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <a href="index.php?page=posts" class="back-link">⬅️ Retour à la liste des posts</a>

    <form method="POST" action="index.php?page=editPost&id=<?= $post->getId() ?>">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post->getTitle()) ?>" required>

        <label for="content">Contenu :</label>
        <textarea id="content" name="content" required><?= htmlspecialchars($post->getContent()) ?></textarea>

        <button type="submit">Modifier</button>
    </form>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
