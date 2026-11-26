<?php
$nama = $email = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim((string)($_POST['nama'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));

    if (!verifikasiCsrf()) $errors[] = 'Token tidak valid.';
    if ($nama === '') $errors[] = 'Nama wajib diisi.';
    if (!validasiEmail($email)) $errors[] = 'Format email tidak valid.';

    if (!$errors) {
        try {
            $stmt = $pdo->prepare('INSERT INTO users (nama, email) VALUES (:nama, :email)');
            $stmt->execute([':nama' => $nama, ':email' => $email]);
            setFlash('success', 'Pengguna berhasil ditambahkan.');
            redirect('user/list');
        } catch (PDOException $ex) {
            $errors[] = ($ex->getCode() === '23000') ? 'Email sudah terdaftar.' : 'Gagal menyimpan data.';
        }
    }
}
?>
<section>
    <h2>Tambah Pengguna</h2>
    <?php foreach ($errors as $er): ?><div class="alert alert-error"><?= e($er) ?></div><?php endforeach; ?>
    <form method="post" action="<?= url('user/add') ?>">
        <?= csrfField() ?>
        <label>Nama</label>
        <input type="text" name="nama" value="<?= e($nama) ?>" required>
        <label>Email</label>
        <input type="text" name="email" value="<?= e($email) ?>" required>
        <button type="submit">Simpan</button>
        <a href="<?= url('user/list') ?>">Batal</a>
    </form>
</section>
