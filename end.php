<?php
// Écran de fin
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fin du jeu</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>🏆 Félicitations !</h1>
    <p>Vous avez terminé le Jeu des Jarres.</p>

    <div class="scores">
        <p>Niveau 1 : <?= $_SESSION['scores']['1'] ?> essais</p>
        <p>Niveau 2 : <?= $_SESSION['scores']['2'] ?> essais</p>
        <p>Niveau 3 : <?= $_SESSION['scores']['3'] ?> essais</p>
    </div>

    <form method="POST" action="index.php">
        <button onclick="
            <?php session_destroy(); ?>
            window.location='index.php'">
            🔄 Rejouer
        </button>
    </form>

    <a href="index.php?reset=1">🔄 Rejouer</a>
</body>

</html>