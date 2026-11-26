<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi PHP Modular</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Aplikasi PHP Modular</h1>
        <p>Contoh pemisahan template, function, dan routing</p>
    </header>
    <nav>
        <a class="<?= navClass('home', $currentPage) ?>" href="<?= url('home') ?>">Home</a>
        <a class="<?= navClass('profil', $currentPage) ?>" href="<?= url('profil') ?>">Profil</a>
        <a class="<?= navClass('kontak', $currentPage) ?>" href="<?= url('kontak') ?>">Kontak</a>
        <a class="<?= navClass('produk', $currentPage) ?>" href="<?= url('produk') ?>">Produk</a>
        <a class="<?= str_starts_with($currentPage, 'user/') ? 'active' : '' ?>" href="<?= url('user/list') ?>">Pengguna</a>
    </nav>
    <main>
        <?= tampilkanFlash() ?>
