# Lab9Web - PHP Modular

## Tujuan
Menerapkan modularisasi PHP: template bersama, function helper, struktur direktori, router aman (whitelist), dan refactoring CRUD.

## Kebutuhan
PHP 8.0+, MySQL/MariaDB, Apache (XAMPP/Laragon), browser.

## Cara Menjalankan
1. Salin folder `Lab9Web` ke docroot (`htdocs`).
2. Import `database.sql` lewat phpMyAdmin.
3. Sesuaikan kredensial di `config/database.php`.
4. Buka `http://localhost/Lab9Web/index.php`.

## Struktur Direktori
```
Lab9Web/
├── index.php            # router
├── config/database.php  # koneksi (PDO)
├── views/               # header, footer, home, profil, kontak, produk, 404
├── helpers/functions.php
├── modules/user/        # list, add, edit, delete
├── assets/css, assets/js
├── database.sql
└── .htaccess            # opsional
```

## Daftar Rute
| page | File |
|---|---|
| home (default) | views/home.php |
| profil | views/profil.php |
| kontak | views/kontak.php |
| produk | views/produk.php |
| user/list | modules/user/list.php |
| user/add | modules/user/add.php |
| user/edit | modules/user/edit.php |
| user/delete | modules/user/delete.php (POST) |

Rute di luar daftar -> HTTP 404 (`views/404.php`).

## Langkah Praktikum
- Latihan 1: header/footer di `views/`, dipanggil router.
- Latihan 2: `formatRupiah`, `hitungDiskon`, `validasiEmail`, `ringkasTeks` di `helpers/functions.php`; dipakai di `produk`, `kontak`, `home`.
- Latihan 3: router whitelist dengan 8 rute + 404.
- Latihan 4: CRUD pengguna (PDO prepared statement, hapus via POST + CSRF, flash message).
- Tantangan: menu aktif, flash message, `.htaccess`.

## Kendala dan Solusi
(Isi dengan kendala yang Anda temui.)
