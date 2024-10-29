<?php
// Array of products with names, quantities, and prices
$products = [
    ["name" => "pepsodent", "quantity" => 30, "price" => 11980],
    ["name" => "sunglight", "quantity" => 15, "price" => 12880],
    ["name" => "baygon", "quantity" => 10, "price" => 16779],
    ["name" => "dove", "quantity" => 20, "price" => 22688],
    ["name" => "rinso", "quantity" => 20, "price" => 20769],
    ["name" => "downy", "quantity" => 15, "price" => 12880],
    ["name" => "le mineral", "quantity" => 25, "price" => 5650],
];

$total = 0;
$discount = 0.1; // 10% discount

echo "<table border='1'>";
echo "<tr><th>Product</th><th>Quantity</th><th>Unit Price</th><th>Subtotal</th></tr>";

foreach ($products as $product) {
    $subtotal = $product["quantity"] * $product["price"];
    $total += $subtotal;
    echo "<tr>
            <td>{$product['name']}</td>
            <td>{$product['quantity']}</td>
            <td>Rp " . number_format($product['price'], 0, ',', '.') . "</td>
            <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
          </tr>";
}

$discountAmount = $total * $discount;
$totalAfterDiscount = $total - $discountAmount;

echo "<tr><td colspan='3'>Total</td><td>Rp " . number_format($total, 0, ',', '.') . "</td></tr>";
echo "<tr><td colspan='3'>Discount (10%)</td><td>Rp " . number_format($discountAmount, 0, ',', '.') . "</td></tr>";
echo "<tr><td colspan='3'>Total After Discount</td><td>Rp " . number_format($totalAfterDiscount, 0, ',', '.') . "</td></tr>";
echo "</table>";
?>
