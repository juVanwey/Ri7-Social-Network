<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ri7 Social Network</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <header>
        <?php include '../views/partials/header.php'; ?>
    </header>
    <main>
        <!-- Publier un post -->
        <h2>Un post entre deux cours ? ✏️📱</h2>
        <p class="subtitle">Un instant à partager, un mood à lâcher 🎤😎</p>

        <form method="POST" action="index.php?page=posts">
            <label for="title">Titre :</label><br>
            <input type="text" id="title" name="title" required><br><br>

            <label for="content">Contenu :</label><br>
            <textarea id="content" name="content" required></textarea><br><br>

            <button type="submit">Publier</button>
        </form>

        <!-- Liste des posts -->
        <h2>Le coin des posts 👀💬</h2>
        <p class="subtitle">Ici, ça cause fort ! 🔊</p>

        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><?= htmlspecialchars($post->getTitle()) ?></h2>
                <p><?= nl2br(htmlspecialchars($post->getContent())) ?></p>
                <small>Par <?= htmlspecialchars($post->getAuthorName()) ?> - <?= $post->getCreatedAt() ?></small>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $post->getAuthorId()): ?>
                    <div style="margin-top: 10px;">
                        <a href="index.php?page=editPost&id=<?= $post->getId() ?>">✏️ Modifier</a> |
                        <a href="index.php?page=deletePost&id=<?= $post->getId() ?>"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');">
                            🗑️ Supprimer
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </main>

    <footer>
        <?php include '../views/partials/footer.php'; ?>
    </footer>

</body>

</html>