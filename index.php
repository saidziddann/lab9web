<?php
// index.php - titik masuk aplikasi (router dengan whitelist)
ob_start(); // agar redirect() di modul tetap bisa dipakai setelah header dimuat
session_start();

require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/config/database.php';

// Whitelist rute: hanya halaman di sini yang boleh diakses
$routes = [
    'home'        => __DIR__ . '/views/home.php',
    'profil'      => __DIR__ . '/views/profil.php',
    'kontak'      => __DIR__ . '/views/kontak.php',
    'produk'      => __DIR__ . '/views/produk.php',
    'user/list'   => __DIR__ . '/modules/user/list.php',
    'user/add'    => __DIR__ . '/modules/user/add.php',
    'user/edit'   => __DIR__ . '/modules/user/edit.php',
    'user/delete' => __DIR__ . '/modules/user/delete.php',
];

$page = $_GET['page'] ?? 'home';

if (!is_string($page) || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $page = '404';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $contentFile = $routes[$page];
}

$currentPage = $page; // dipakai header.php untuk menu aktif

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
ob_end_flush();
