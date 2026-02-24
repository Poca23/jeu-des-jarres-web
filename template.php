<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $titre ?>
    </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php if ($vue === 'end'): ?>

        <h1>🏆 Félicitations !</h1>
        <p>Vous avez terminé le Jeu des Jarres.</p>
        <div class="scores">
            <p>Niveau 1 :
                <?= $_SESSION['scores']['1'] ?> essais
            </p>
            <p>Niveau 2 :
                <?= $_SESSION['scores']['2'] ?> essais
            </p>
            <p>Niveau 3 :
                <?= $_SESSION['scores']['3'] ?> essais
            </p>
        </div>
        <a href="index.php?reset=1">🔄 Rejouer</a>

    <?php elseif ($vue === 'difficulte'): ?>

        <h1>🏺
            <?= $titre ?>
        </h1>
        <p>Objectif : choisir une difficulté, puis trouver la clé.</p>
        <form method="POST">
            <button name="difficulte" value="1">😊 Facile (1 serpent)</button>
            <button name="difficulte" value="2">😐 Moyen (2 serpents)</button>
            <button name="difficulte" value="3">😈 Difficile (3 serpents)</button>
        </form>

    <?php elseif ($vue === 'jarres'): ?>

        <h1>🏺
            <?= $titre ?>
        </h1>

        <?php if ($titre === 'Niveau 1'): ?>
            <p>Objectif : trouver la jarre avec la clé.</p>
        <?php elseif ($titre === 'Niveau 2'): ?>
            <p>Objectif : trouver 3 clés consécutives.</p>
            <p>Progression :
                <?= $_SESSION['clesuite'] ?>/3
            </p>
        <?php elseif ($titre === 'Niveau 3'): ?>
            <p>Difficulté : <?= $_SESSION['difficulte'] ?> serpent(s)</p>
            <p>Progression : <?= $_SESSION['clesuite'] ?>/3
            </p>
        <?php endif; ?>

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
                <?= $_SESSION['scores']['1'] ?? 'pas encore joué' ?>
            </p>
            <p>Niveau 2 :
                <?= $_SESSION['scores']['2'] ?? 'pas encore joué' ?>
            </p>
            <p>Niveau 3 :
                <?= $_SESSION['scores']['3'] ?? 'pas encore joué' ?>
            </p>
        </div>

    <?php endif; ?>

</body>

</html>