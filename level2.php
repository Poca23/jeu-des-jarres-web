<?php
$message = '';
$titre = 'Niveau 2';
$vue = 'jarres';

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

require 'template.php';
