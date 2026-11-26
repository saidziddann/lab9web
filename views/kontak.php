<?php
$pesanError = '';
$sukses = false;
$nama = $email = $isi = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim((string)($_POST['nama'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $isi   = trim((string)($_POST['pesan'] ?? ''));

    if (!verifikasiCsrf()) {
        $pesanError = 'Token tidak valid.';
    } elseif ($nama === '' || $isi === '') {
        $pesanError = 'Nama dan pesan wajib diisi.';
    } elseif (!validasiEmail($email)) {
        $pesanError = 'Format email tidak valid.';
    } else {
        $sukses = true;
    }
}
?>
<section class="content">
    <h2>Kontak</h2>
    <?php if ($pesanError): ?><div class="alert alert-error"><?= e($pesanError) ?></div><?php endif; ?>
    <?php if ($sukses): ?>
        <div class="alert alert-success">Terima kasih, <?= e($nama) ?>. Pesan Anda: "<?= e(ringkasTeks($isi, 60)) ?>"</div>
    <?php endif; ?>
    <form method="post" action="<?= url('kontak') ?>">
        <?= csrfField() ?>
        <label>Nama</label>
        <input type="text" name="nama" value="<?= e($nama) ?>" required>
        <label>Email</label>
        <input type="text" name="email" value="<?= e($email) ?>" required>
        <label>Pesan</label>
        <textarea name="pesan" rows="4" required><?= e($isi) ?></textarea>
        <button type="submit">Kirim</button>
    </form>
</section>
