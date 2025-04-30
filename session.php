<?php
session_start();

$currentPage = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Só redireciona se não estiver no login
    if ($currentPage !== 'login.php') {
        header("Location: login.php");
        exit();
    }
}
