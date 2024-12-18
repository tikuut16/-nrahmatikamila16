<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas PHP - Associative Array</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Data Berdasarkan Kategori</h1>
    <?php
    // Tiga digit terakhir NRP
    $nrp = 12345; // Ganti dengan tiga digit terakhir NRP Anda
    $kategori = $nrp % 5;

    // Data berdasarkan kategori
    $data = [];
    $judul_kategori = "";

    switch ($kategori) {
        case 1: // Budaya Daerah di Indonesia
            $judul_kategori = "Budaya Daerah di Indonesia";
            $data = [
                [
                    "nama" => "Batik",
                    "asal" => "Jawa",
                    "deskripsi" => "Seni kain tradisional yang diakui UNESCO.",
                    "tahun" => 2009,
                    "gambar" => "https://example.com/batik.jpg"
                ],
                [
                    "nama" => "Angklung",
                    "asal" => "Jawa Barat",
                    "deskripsi" => "Alat musik bambu tradisional.",
                    "tahun" => 2010,
                    "gambar" => "https://example.com/angklung.jpg"
                ],
                [
                    "nama" => "Tari Piring",
                    "asal" => "Sumatera Barat",
                    "deskripsi" => "Tarian tradisional menggunakan piring.",
                    "tahun" => 1995,
                    "gambar" => "https://example.com/tari-piring.jpg"
                ]
                // Tambahkan data lainnya
            ];
            break;
        case 2: // Penemu terkenal di dunia
            $judul_kategori = "Penemu-Penemu Terkenal di Dunia";
            $data = [
                [
                    "nama" => "Albert Einstein",
                    "penemuan" => "Teori Relativitas",
                    "tahun" => 1905,
                    "kebangsaan" => "Jerman",
                    "gambar" => "https://example.com/einstein.jpg"
                ],
                [
                    "nama" => "Isaac Newton",
                    "penemuan" => "Hukum Gravitasi",
                    "tahun" => 1687,
                    "kebangsaan" => "Inggris",
                    "gambar" => "https://example.com/newton.jpg"
                ],
                [
                    "nama" => "Nikola Tesla",
                    "penemuan" => "Listrik Arus AC",
                    "tahun" => 1888,
                    "kebangsaan" => "Serbia",
                    "gambar" => "https://example.com/tesla.jpg"
                ]
                // Tambahkan data lainnya
            ];
            break;
        case 3: // Flora dan Fauna terancam punah
            $judul_kategori = "Flora dan Fauna Terancam Punah";
            $data = [
                [
                    "nama" => "Harimau Sumatera",
                    "status" => "Kritis",
                    "habitat" => "Sumatera",
                    "jumlah" => 400,
                    "gambar" => "https://example.com/harimau.jpg"
                ],
                [
                    "nama" => "Badak Jawa",
                    "status" => "Kritis",
                    "habitat" => "Ujung Kulon",
                    "jumlah" => 72,
                    "gambar" => "https://example.com/badak.jpg"
                ],
                [
                    "nama" => "Elang Jawa",
                    "status" => "Kritis",
                    "habitat" => "Jawa",
                    "jumlah" => 300,
                    "gambar" => "https://example.com/elang.jpg"
                ]
                // Tambahkan data lainnya
            ];
            break;
        case 4: // Pahlawan Nasional Indonesia
            $judul_kategori = "Pahlawan Nasional Indonesia";
            $data = [
                [
                    "nama" => "Soekarno",
                    "gelar" => "Proklamator",
                    "tahun" => 1901,
                    "asal" => "Blitar",
                    "gambar" => "https://example.com/soekarno.jpg"
                ],
                [
                    "nama" => "RA Kartini",
                    "gelar" => "Pahlawan Emansipasi",
                    "tahun" => 1879,
                    "asal" => "Jepara",
                    "gambar" => "https://example.com/kartini.jpg"
                ],
                [
                    "nama" => "Diponegoro",
                    "gelar" => "Pahlawan Perjuangan",
                    "tahun" => 1785,
                    "asal" => "Yogyakarta",
                    "gambar" => "https://example.com/diponegoro.jpg"
                ]
                // Tambahkan data lainnya
            ];
            break;
        case 0: // Perusahaan Teknologi
            $judul_kategori = "Perusahaan Teknologi";
            $data = [
                [
                    "nama" => "Apple",
                    "pendiri" => "Steve Jobs",
                    "tahun" => 1976,
                    "produk" => "iPhone",
                    "gambar" => "https://example.com/apple.jpg"
                ],
                [
                    "nama" => "Microsoft",
                    "pendiri" => "Bill Gates",
                    "tahun" => 1975,
                    "produk" => "Windows",
                    "gambar" => "https://example.com/microsoft.jpg"
                ],
                [
                    "nama" => "Google",
                    "pendiri" => "Larry Page & Sergey Brin",
                    "tahun" => 1998,
                    "produk" => "Search Engine",
                    "gambar" => "https://example.com/google.jpg"
                ]
                // Tambahkan data lainnya
            ];
            break;
    }

    // Tampilkan tabel data
    echo "<h2>Kategori: $judul_kategori</h2>";
    echo "<table>";
    echo "<tr>";
    foreach (array_keys($data[0]) as $field) {
        echo "<th>" . ucfirst($field) . "</th>";
    }
    echo "</tr>";

    foreach ($data as $item) {
        echo "<tr>";
        foreach ($item as $key => $value) {
            if ($key === "gambar") {
                echo "<td><img src='$value' alt='Gambar'></td>";
            } else {
                echo "<td>$value</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>
</html>