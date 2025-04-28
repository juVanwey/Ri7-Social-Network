<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ri7 Social Network</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="wrapper"> 
        <!-- fermeture du wrapper dans footer.php -->
        <header>
            <h1>Bienvenue sur Ri7 Social Network</h1>
            <p>L'endroit où les camarades se retrouvent, les idées circulent et les projets prennent vie !</p>

            <?php if (isset($_SESSION['user'])): ?>
                <p>Connecté en tant que <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong> |
                    <a href="index.php?page=logout">Déconnexion</a>
                </p>
            <?php else: ?>
                <!-- <p>
                <a href="index.php?page=login">Connexion</a> |
                <a href="index.php?page=register">Inscription</a>
            </p> -->
            <?php endif; ?>
        </header>
</body>