<?php
// helpers/functions.php - function umum yang dipakai banyak modul

/** Escape teks sebelum ditampilkan ke HTML. */
function e(string $nilai): string
{
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

/** Format angka menjadi Rupiah, contoh: 150000 => "Rp 150.000". */
function formatRupiah(float $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

/** Hitung nominal diskon (bukan harga akhir). Default diskon 10%. */
function hitungDiskon(float $harga, float $persen = 10): float
{
    return $harga * ($persen / 100);
}

/** Validasi format email. Mengembalikan true jika valid. */
function validasiEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/** Ringkas teks panjang menjadi maksimal $batas karakter + "...". */
function ringkasTeks(string $teks, int $batas = 100): string
{
    $teks = trim($teks);
    if (mb_strlen($teks, 'UTF-8') <= $batas) {
        return $teks;
    }
    return rtrim(mb_substr($teks, 0, $batas, 'UTF-8')) . '...';
}

/** Buat URL berbasis router: url('user/edit', ['id' => 3]). */
function url(string $page, array $params = []): string
{
    return 'index.php?' . http_build_query(['page' => $page] + $params);
}

/** Redirect ke rute tertentu lalu hentikan eksekusi. */
function redirect(string $page, array $params = []): void
{
    header('Location: ' . url($page, $params));
    exit;
}

/** Kembalikan class "active" jika rute sedang dibuka (menu aktif). */
function navClass(string $route, string $current): string
{
    return $route === $current ? 'active' : '';
}

/* ---------- Pesan flash ---------- */
function setFlash(string $tipe, string $pesan): void
{
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function tampilkanFlash(): string
{
    if (empty($_SESSION['flash'])) {
        return '';
    }
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return '<div class="alert alert-' . e($f['tipe']) . '">' . e($f['pesan']) . '</div>';
}

/* ---------- CSRF ---------- */
function csrfToken(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrfField(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrfToken()) . '">';
}

function verifikasiCsrf(): bool
{
    return isset($_POST['csrf'], $_SESSION['csrf'])
        && is_string($_POST['csrf'])
        && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}
