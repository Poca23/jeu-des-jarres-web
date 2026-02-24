<?php
// Level 3 — Difficulté + trouver une clé

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Choix de la difficulté
    if (isset($_POST['difficulte'])) {
        $d = $_POST['difficulte'];
        if (is_numeric($d) && $d >= 1 && $d <= 3) {
            $_SESSION['difficulte'] = (int) $d;
        }
    }

    // Choix d'une jarre
    elseif (isset($_POST['jarre']) && isset($_SESSION['difficulte'])) {
        $choix = $_POST['jarre'];

        if (is_numeric($choix) && $choix >= 1 && $choix <= 5) {
            $nb = $_SESSION['difficulte'];
            $jarres = array_merge(
                array_fill(0, $nb, 'serpent'),
                array_fill(0, 5 - $nb, 'clé')
            );
            shuffle($jarres);
            $_SESSION['essais']++;

            if ($jarres[$choix - 1] === 'serpent') {
                $message = "🐍 Serpent ! Recommencez.";
            } else {
                $_SESSION['scores']['3'] = $_SESSION['essais'];
                $_SESSION['level'] = 'end';
                header('Location: index.php');
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Niveau 3</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>🏺 Niveau 3</h1>
    <p>Objectif : choisir une difficulté, puis trouver la clé.</p>

    <?php if (!isset($_SESSION['difficulte'])): ?>
        <form method="POST">
            <button name="difficulte" value="1">😊 Facile (1 serpent)</button>
            <button name="difficulte" value="2">😐 Moyen (2 serpents)</button>
            <button name="difficulte" value="3">😈 Difficile (3 serpents)</button>
        </form>

    <?php else: ?>
        <p>Difficulté : <?= $_SESSION['difficulte'] ?> serpent(s)</p>

        <?php if ($message): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>

        <form method="POST">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <button name="jarre" value="<?= $i ?>">Jarre <?= $i ?></button>
            <?php endfor; ?>
        </form>
    <?php endif; ?>

    <div class="scores">
        <p>Essais : <?= $_SESSION['essais'] ?></p>
        <p>Niveau 1 : <?= $_SESSION['scores']['1'] ?? 'pas encore joué' ?> essais</p>
        <p>Niveau 2 : <?= $_SESSION['scores']['2'] ?? 'pas encore joué' ?> essais</p>
        <p>Niveau 3 : <?= $_SESSION['scores']['3'] ?? 'pas encore joué' ?></p>
    </div>
</body>

</html>