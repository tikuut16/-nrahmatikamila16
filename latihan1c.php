<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 1c</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            width: 120px;
        }
        .box {
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid black;
            margin: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $data = [
            ["A"],
            ["A", "B"],
            ["A", "B", "C"]
        ];

        foreach ($data as $row) {
            foreach ($row as $letter) {
                echo "<div class='box'>$letter</div>";
            }
            echo "<div style='flex-basis: 100%;'></div>";
        }
        ?>
    </div>
</body>
</html>