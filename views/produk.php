<?php
$produk = [
    ['nama' => 'Laptop',   'harga' => 8500000, 'diskon' => 10],
    ['nama' => 'Mouse',    'harga' => 150000,  'diskon' => 15],
    ['nama' => 'Keyboard', 'harga' => 450000,  'diskon' => 5],
];
?>
<section class="content">
    <h2>Daftar Produk</h2>
    <table>
        <tr><th>Produk</th><th>Harga</th><th>Diskon</th><th>Harga Akhir</th></tr>
        <?php foreach ($produk as $p):
            $potongan = hitungDiskon($p['harga'], $p['diskon']); ?>
            <tr>
                <td><?= e($p['nama']) ?></td>
                <td><?= formatRupiah($p['harga']) ?></td>
                <td><?= $p['diskon'] ?>% (<?= formatRupiah($potongan) ?>)</td>
                <td><?= formatRupiah($p['harga'] - $potongan) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
