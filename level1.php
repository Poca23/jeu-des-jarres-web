<?php
$message = '';
$titre = 'Niveau 1';
$vue = 'jarres';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $choix = $_POST['jarre'] ?? 0;

    if (is_numeric($choix) && $choix >= 1 && $choix <= 5) {
        $jarres = ['serpent', 'clé', 'clé', 'clé', 'clé'];
        shuffle($jarres);
        $_SESSION['essais']++;

        if ($jarres[$choix - 1] === 'serpent') {
            $message = "🐍 Aïe ! Un serpent ! Recommencez.";
        } else {
            $_SESSION['scores']['1'] = $_SESSION['essais'];
            $_SESSION['essais'] = 0;
            $_SESSION['level'] = 2;
            header('Location: index.php');
            exit;
        }
    }
}

require 'template.php';
