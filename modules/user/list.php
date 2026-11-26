<?php
$users = $pdo->query('SELECT id, nama, email FROM user ORDER BY id DESC')->fetchAll();
?>
<section>
    <h2>Data Pengguna</h2>
    <p><a class="btn" href="<?= url('user/add') ?>">+ Tambah Pengguna</a></p>
    <table>
        <tr><th>No</th><th>Nama</th><th>Email</th><th>Aksi</th></tr>
        <?php if (!$users): ?>
            <tr><td colspan="4">Belum ada data.</td></tr>
        <?php endif; ?>
        <?php foreach ($users as $i => $u): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= e($u['nama']) ?></td>
                <td><?= e($u['email']) ?></td>
                <td>
                    <a href="<?= url('user/edit', ['id' => $u['id']]) ?>">Edit</a>
                    <form method="post" action="<?= url('user/delete') ?>" class="inline"
                          onsubmit="return confirm('Hapus pengguna ini?');">
                        <?= csrfField() ?>
                        <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
                        <button type="submit" class="danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
