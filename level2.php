<?php
// Level 2 — 3 clés consécutives

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $choix = $_POST['jarre'] ?? 0;

    if (is_numeric($choix) && $choix >= 1 && $choix <= 5) {
        $jarres = ['serpent', 'clé', 'clé', 'clé', 'clé'];
        shuffle($jarres);
        $_SESSION['essais']++;

        if ($jarres[$choix - 1] === 'serpent') {
            $message = "🐍 Serpent ! Compteur remis à zéro.";
            $_SESSION['clesuite'] = 0;
        } else {
            $_SESSION['clesuite']++;
            $message = "🗝️ Clé trouvée ! (" . $_SESSION['clesuite'] . "/3)";

            if ($_SESSION['clesuite'] === 3) {
                $_SESSION['scores']['2'] = $_SESSION['essais'];
                $_SESSION['essais'] = 0;
                $_SESSION['clesuite'] = 0;
                $_SESSION['level'] = 3;
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
    <title>Niveau 2</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>🏺 Niveau 2</h1>
    <p>Objectif : trouver 3 clés consécutives.</p>
    <p>Progression :
        <?= $_SESSION['clesuite'] ?>/3
    </p>

    <?php if ($message): ?>
        <p class="message">
            <?= $message ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <button name="jarre" value="<?= $i ?>">Jarre
                <?= $i ?>
            </button>
        <?php endfor; ?>
    </form>

    <div class="scores">
        <p>Essais :
            <?= $_SESSION['essais'] ?>
        </p>
        <p>Niveau 1 :
            <?= $_SESSION['scores']['1'] ?? 'pas encore joué' ?> essais
        </p>
        <p>Niveau 2 :
            <?= $_SESSION['scores']['2'] ?? 'pas encore joué' ?>
        </p>
        <p>Niveau 3 :
            <?= $_SESSION['scores']['3'] ?? 'pas encore joué' ?>
        </p>
    </div>
</body>

</html>