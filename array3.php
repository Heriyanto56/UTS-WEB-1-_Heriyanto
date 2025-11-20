<?php
$barang = [
    ["B001", "LAPTOP", 5000],
    ["B002", "PRINTER", 3000],
    ["B003", "SCANER", 2000],
];
//echo $barang[0][1] . "<br>"; // laptop
//print_r($barang); // menampilkan seluruh isi array multidimensi
echo "<br";
//var_dump($barang); // menampilkan isi lengkap array multidimensi
foreach ($barang as $i => $b) {
    echo "Data Barang ke-$i <br>";
    echo "Kode Barang ke-$b[0] <br>";
    echo "Nama Barang ke-$b[1]<br>";
    echo "harga Barang ke-$b[1] <br>";
    echo "<br>";
}
?>