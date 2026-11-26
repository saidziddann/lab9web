<?php
$id = filter_var($_GET['id'] ?? $_POST['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
    setFlash('error', 'ID pengguna tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('SELECT id, nama, email FROM users WHERE id = :id');
$stmt->execute([':id' => $id]);
$user = $stmt->fetch();
if (!$user) {
    setFlash('error', 'Pengguna tidak ditemukan.');
    redirect('user/list');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user['nama']  = trim((string)($_POST['nama'] ?? ''));
    $user['email'] = trim((string)($_POST['email'] ?? ''));

    if (!verifikasiCsrf()) $errors[] = 'Token tidak valid.';
    if ($user['nama'] === '') $errors[] = 'Nama wajib diisi.';
    if (!validasiEmail($user['email'])) $errors[] = 'Format email tidak valid.';

    if (!$errors) {
        try {
            $upd = $pdo->prepare('UPDATE users SET nama = :nama, email = :email WHERE id = :id');
            $upd->execute([':nama' => $user['nama'], ':email' => $user['email'], ':id' => $id]);
            setFlash('success', 'Data pengguna berhasil diubah.');
            redirect('user/list');
        } catch (PDOException $ex) {
            $errors[] = ($ex->getCode() === '23000') ? 'Email sudah dipakai pengguna lain.' : 'Gagal mengubah data.';
        }
    }
}
?>
<section>
    <h2>Edit Pengguna</h2>
    <?php foreach ($errors as $er): ?><div class="alert alert-error"><?= e($er) ?></div><?php endforeach; ?>
    <form method="post" action="<?= url('user/edit', ['id' => $id]) ?>">
        <?= csrfField() ?>
        <input type="hidden" name="id" value="<?= (int)$id ?>">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= e($user['nama']) ?>" required>
        <label>Email</label>
        <input type="text" name="email" value="<?= e($user['email']) ?>" required>
        <button type="submit">Perbarui</button>
        <a href="<?= url('user/list') ?>">Batal</a>
    </form>
</section>
