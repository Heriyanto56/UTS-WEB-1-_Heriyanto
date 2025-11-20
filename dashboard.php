<?php
// ✅ Commit 1 & 3 - Start Session & Cek Login
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// ✅ Commit 5 - Setup Awal: Data Barang
$daftar_produk = [
    [
        'kode_barang' => 'B001',
        'nama_barang' => 'Laptop',
        'harga_barang' => 5000
    ],
    [
        'kode_barang' => 'B002',
        'nama_barang' => 'Printer',
        'harga_barang' => 3000
    ],
    [
        'kode_barang' => 'B003',
        'nama_barang' => 'Scanner',
        'harga_barang' => 2000
    ],
];

// ✅ Commit 6 - Logika Penjualan Random
$detail_pembelian = [];
$grandtotal = 0;
$jumlah_produk_tersedia = count($daftar_produk);

// Jumlah item transaksi acak (misalnya 3–6 item)
$jumlah_item_transaksi = rand(3, 6);

for ($i = 0; $i < $jumlah_item_transaksi; $i++) {
    // Pilih produk secara acak
    $index_produk_acak = rand(0, $jumlah_produk_tersedia - 1);
    $produk = $daftar_produk[$index_produk_acak];

    // Tentukan jumlah pembelian acak (1–5)
    $jumlah = rand(1, 5);

    // Hitung total harga per item
    $total_item = $produk['harga_barang'] * $jumlah;

    // Simpan ke array detail pembelian
    $detail_pembelian[] = [
        'kode' => $produk['kode_barang'],
        'nama' => $produk['nama_barang'],
        'harga' => $produk['harga_barang'],
        'jumlah' => $jumlah,
        'total_item' => $total_item
    ];

    // Akumulasikan grand total
    $grandtotal += $total_item;
}

// ✅ Commit Tambahan – Diskon
$diskon = 0;
if ($grandtotal > 50000) {
    $diskon = 0.10 * $grandtotal; // Diskon 10%
}
$total_akhir = $grandtotal - $diskon;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polgan Mart - Dashboard Penjualan</title> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .header-top {
            width: 80%;
            max-width: 900px;
            display: flex;
            justify-content: flex-end;
            padding: 10px 0;
            margin-top: 20px;
        }
        .user-info {
            text-align: right;
            font-size: 0.9em;
        }
        .user-info a {
            color: #004d40;
            text-decoration: none;
            font-weight: bold;
        }
        .card {
            width: 80%;
            max-width: 900px;
            margin-top: 10px;
            padding: 25px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .logo-section {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo-icon {
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: bold;
            margin-right: 15px;
        }
        .logo-text h2 {
            margin: 0;
            font-size: 1.5em;
            color: #004d40;
        }
        .logo-text p {
            margin: 0;
            font-size: 0.8em;
            color: #666;
        }
        .sales-table { 
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .sales-table th, .sales-table td {
            border-bottom: 1px solid #eee;
            padding: 12px 15px;
            text-align: left;
        }
        .sales-table th {
            background-color: #f7f7f7;
            text-transform: capitalize;
            font-size: 1em;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .total-row td {
            font-weight: bold;
            font-size: 1.05em;
            border-top: 2px solid #ccc;
        }
        .total-row td:first-child {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header-top">
        <div class="user-info">
            Selamat datang, <?php echo htmlspecialchars($_SESSION['username'] ?? 'admin'); ?>! <br>
            Role: <?php echo htmlspecialchars($_SESSION['role'] ?? 'Dosen'); ?><br>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    
    <div class="card">
        <div class="logo-section">
            <div class="logo-icon">PM</div>
            <div class="logo-text">
                <h2>--POLGAN MART--</h2>
                <p>Sistem Penjualan Sederhana</p>
            </div>
        </div>

        <h3 style="text-align: center; margin-top: 30px;">Daftar Pembelian</h3>
        <p style="text-align: center; font-size: 0.9em; color: #999;">
            Daftar pembelian dibuat secara acak tiap kali halaman dimuat
        </p>
        
        <table class="sales-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th class="text-right">Jumlah</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail_pembelian as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['kode']); ?></td>
                    <td><?php echo htmlspecialchars($item['nama']); ?></td>
                    <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td class="text-right"><?php echo htmlspecialchars($item['jumlah']); ?></td>
                    <td class="text-right">Rp <?php echo number_format($item['total_item'], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4" class="text-right">Total Belanja:</td>
                    <td class="text-right">Rp <?php echo number_format($grandtotal, 0, ',', '.'); ?></td>
                </tr>
                <?php if ($diskon > 0): ?>
                <tr class="total-row">
                    <td colspan="4" class="text-right" style="color: green;">Diskon (10%):</td>
                    <td class="text-right" style="color: green;">- Rp <?php echo number_format($diskon, 0, ',', '.'); ?></td>
                </tr>
                <?php endif; ?>
                <tr class="total-row">
                    <td colspan="4" class="text-right"><b>Total Akhir:</b></td>
                    <td class="text-right"><b>Rp <?php echo number_format($total_akhir, 0, ',', '.'); ?></b></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>