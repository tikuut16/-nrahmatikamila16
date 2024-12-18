<?php
// Membuat associative array dengan nama negara sebagai key dan ibukota sebagai value
$negaraAsean = [
    "Indonesia" => "D.K.I. Jakarta",
    "Singapura" => "Singapura",
    "Malaysia" => "Kuala Lumpur",
    "Brunei" => "Bandar Seri Begawan",
    "Thailand" => "Bangkok",
    "Laos" => "Vientiane",
    "Filipina" => "Manila",
    "Myanmar" => "Naypyidaw"
];

// Menampilkan daftar negara ASEAN dan ibukotanya
echo "<h2>Daftar Negara ASEAN dan Ibukota:</h2>";
echo "<ul>";
foreach ($negaraAsean as $negara => $ibukota) {
    echo "<li>$negara: $ibukota</li>";
}
echo "</ul>";
?>