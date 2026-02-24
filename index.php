<?php
session_start();

// Initialisation
if (!isset($_SESSION['level'])) {
    $_SESSION['level'] = 1;
    $_SESSION['scores'] = ['1' => null, '2' => null, '3' => null];
    $_SESSION['essais'] = 0;
    $_SESSION['clesuite'] = 0;
}

$level = $_SESSION['level'];

// Bon niveau
if ($level === 'end') {
    require 'end.php';
} else {
    require 'level' . $level . '.php';
}
