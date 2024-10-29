<?php
// Data barang dan transaksi
$barang = [
    ['nama' => 'Pepsodent', 'stok' => 30, 'harga' => 11980],
    ['nama' => 'Sunlight', 'stok' => 15, 'harga' => 12880],
    ['nama' => 'Baygon', 'stok' => 10, 'harga' => 16779],
    ['nama' => 'Dove', 'stok' => 20, 'harga' => 22688],
    ['nama' => 'rinso', 'stok' => 20, 'harga' => 20769],
    ['nama' => 'downy', 'stok' => 15, 'harga' => 12880],
    ['nama' => 'le mineral', 'stok' => 25, 'harga' => 5650]
];

$transaksi = [
    ['nama' => 'Pepsodent', 'jumlah_terjual' => 5],
    ['nama' => 'Sunlight', 'jumlah_terjual' => 2],
    ['nama' => 'baygon', 'jumlah_terjual' => 3],
    ['nama' => 'dove', 'jumlah_terjual' => 1],
    ['nama' => 'rinso', 'jumlah_terjual' => 4],
    ['nama' => 'downy', 'jumlah_terjual' => 3],
    ['nama' => 'le mineral', 'jumlah_terjual' => 2]
];

// Total pembelian
$total_pembelian = 0;
$diskon = 0.2; // 20% diskon

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .struk { width: 300px; margin: 0 auto; }
        .struk h2 { text-align: center; }
        .struk table { width: 100%; }
        .struk th, .struk td { padding: 5px; text-align: left; }
        .struk .total { font-weight: bold; }
        .struk .align-right { text-align: right; }
    </style>
</head>
<body>

<div class="struk">
    <h2>Struk Pembayaran</h2>
    <p>Tanggal Transaksi: 28 Oktober 2024</p>
    <table border="0">
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
        <?php foreach ($transaksi as $t): ?>
            <?php
            // Cari harga barang berdasarkan nama
            foreach ($barang as $b) {
                if ($b['nama'] == $t['nama']) {
                    $harga = $b['harga'];
                    break;
                }
            }
            $total_harga = $harga * $t['jumlah_terjual'];
            $total_pembelian += $total_harga;
            ?>
            <tr>
                <td><?php echo $t['nama']; ?></td>
                <td>Rp <?php echo number_format($harga, 0, ',', '.'); ?></td>
                <td><?php echo $t['jumlah_terjual']; ?></td>
                <td>Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" class="align-right">Total Pembelian:</td>
            <td>Rp <?php echo number_format($total_pembelian, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td colspan="3" class="align-right">Diskon 20%:</td>
            <td>Rp <?php echo number_format($total_pembelian * $diskon, 0, ',', '.'); ?></td>
        </tr>
        <tr class="total">
            <td colspan="3" class="align-right">Total Pembayaran:</td>
            <td>Rp <?php echo number_format($total_pembelian * (1 - $diskon), 0, ',', '.'); ?></td>
        </tr>
    </table>
    <p style="text-align: center;">Terima kasih atas kunjungan Anda!</p>
</div>

</body>
</html>
