<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

// menghapus cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    unset($_COOKIE['id']);
    unset($_COOKIE['key']);
    setcookie('id', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
    setcookie('key', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
}

header("location: ../pages/index");
exit;