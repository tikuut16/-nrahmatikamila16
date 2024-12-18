<html>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
</html>

<?php
// Membuat array multidimensi untuk menyimpan data negara
$negara = array(
    "Indonesia" => array(
    "ibukota" => "D.K.I. Jakarta",
    "kode_telepon" => "+62"       
    ),
    "Singapura" => array(
    "ibukota" => "Singapura",
    "kode_telepon" => "+65"       
    ),
    "Malaysia" => array(
    "ibukota" => "Kuala Lumpur",
    "kode_telepon" => "+60"  
    ),
    "Brunei" => array(
    "ibukota" => "Bandar Seri Begawan",
    "kode_telepon" => "+673"  
    ),
    "Thailand" => array(
    "ibukota" => "Bangkok",
    "kode_telepon" => "+66"  
    ),
    "Laos" => array(
    "ibukota" => "Viantiane",
    "kode_telepon" => "+856"  
    ), 
    "Filipina" => array(
    "ibukota" => "Manila",
    "kode_telepon" => "+63"  
    ), 
    "Myanmar" => array(
    "ibukota" => "Naypydaw",
    "kode_telepon" => "+95"  
    ), 
);

// Menampilkan data dalam bentuk tabel HTML
echo "<table>";
echo "<tr><th>Negara</th><th>Ibukota</th><th>Kode Telepon</th>";
foreach ($negara as $negara_name => $negara_data) {
    echo "<tr>";
    echo "<td>" . $negara_name . "</td>";
    echo "<td>" . $negara_data['ibukota'] . "</td>";
    echo "<td>" . $negara_data['kode_telepon'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>