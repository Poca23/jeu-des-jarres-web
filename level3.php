<?php
$message = '';
$titre = 'Niveau 3';
$vue = isset($_SESSION['difficulte']) ? 'jarres' : 'difficulte';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['difficulte'])) {
        $d = $_POST['difficulte'];
        if (is_numeric($d) && $d >= 1 && $d <= 3) {
            $_SESSION['difficulte'] = (int) $d;
            $_SESSION['clesuite'] = 0;
            $vue = 'jarres';
        }
    } elseif (isset($_POST['jarre'], $_SESSION['difficulte'])) {
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
                $_SESSION['clesuite'] = 0;
                $message = "🐍 Serpent ! Retour à zéro.";
            } else {
                $_SESSION['clesuite']++;
                $message = "🗝️ Clé trouvée ! (" . $_SESSION['clesuite'] . "/3)";

                if ($_SESSION['clesuite'] === 3) {
                    $_SESSION['scores']['3'] = $_SESSION['essais'];
                    $_SESSION['level'] = 'end';
                    header('Location: index.php');
                    exit;
                }
            }
        }
    }
}

require 'template.php';
