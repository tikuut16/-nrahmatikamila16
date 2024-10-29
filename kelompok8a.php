<?php
// Array of products with stock and price
$products = [
    ["id" => 1, "name" => "Pepsodent", "stock" => 30, "price" => 11980],
    ["id" => 2, "name" => "Sunglight", "stock" => 15, "price" => 12880],
    ["id" => 3, "name" => "Baygon", "stock" => 10, "price" => 16779],
    ["id" => 4, "name" => "Dove", "stock" => 20, "price" => 22688],
    ["id" => 5, "name" => "Binso", "stock" => 20, "price" => 20769],
    ["id" => 6, "name" => "Downy", "stock" => 15, "price" => 12880],
    ["id" => 7, "name" => "Le Mineral", "stock" => 25, "price" => 5650]
];

// Initialize grand total
$grandTotal = 0;

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Produk</th><th>Stok</th><th>Harga</th><th>Jumlah</th></tr>";

foreach ($products as $product) {
    $jumlah = $product['stock'] * $product['price'];
    $grandTotal += $jumlah;

    echo "<tr>";
    echo "<td>{$product['id']}</td>";
    echo "<td>{$product['name']}</td>";
    echo "<td>{$product['stock']}</td>";
    echo "<td>{$product['price']}</td>";
    echo "<td>{$jumlah}</td>";
    echo "</tr>";
}

echo "<tr><td colspan='4'>Total</td><td>{$grandTotal}</td></tr>";
echo "</table>";
?>
