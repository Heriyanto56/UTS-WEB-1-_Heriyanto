<?php

session_start();

// Cek apakah user sudah login

if (isset($_SESSION['username'])) {
header("Location: login.php");
exit;
}
?>
<html>
    <title>login</title>
</head>
<title>Dashboard</title>

</head>

<body>
<h2>Selamat datang, <?php echo $_SESSION['username']; ?>1</h2>
<p>Role: <?php echo $_SESSION['role']; ?></p>
<a href="1ogout .php">Logout</a>

</body>

</html>

// Commit 5 – Setup Awal
echo "<h2>--POLGAN MART--</h2>";
echo "<p>Selamat datang, " . $_SESSION['username'] . "!</p><hr>";

// Data produk (array)
$kode_barang = ["B001", "B002", "B003", "B004", "B005"];
$nama_barang = ["coca-cola", "Sukro", "Kacang Dua Kelinci", "Floridina", "Lays"];
$harga_barang = [5000, 12000, 8000, 7000, 15000];
