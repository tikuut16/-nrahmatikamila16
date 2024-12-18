<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Looping PHP</title>
    <style>
        .kotak {
            width: 30px;
            height: 30px;
            border: 1px solid black;
            text-align: center;
            line-height: 30px;
            margin: 2px;
            float: left;
        }
        .ganjil {
            background-color: #003; /* Biru gelap */
            color: #fff;          /* Teks putih */
        }
        .genap {
            background-color: #999; /* Abu-abu */
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <?php
    $rows = 5; // Jumlah baris

    for ($i = 1; $i <= $rows; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            // Menentukan kelas berdasarkan ganjil atau genap
            $class = ($j % 2 == 0) ? "genap" : "ganjil";
            echo "<div class='kotak $class'>$j</div>";
        }
        echo "<div class='clear'></div>";
    }
    ?>
</body>
</html>
