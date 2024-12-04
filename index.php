<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi Voucher Printer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .vouchers {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0;
            margin: 0;
            padding: 0;
        }
        .voucher {
            border: 2px solid #000;
            padding: 10px;
            margin: 0;
            box-sizing: border-box;
            text-align: center;
            font-size: 14px;
        }
        .voucher h2 {
            margin: 5px 0;
            font-size: 14px;
        }
        .voucher .password {
            border: 2px solid #000;
            margin: 5px 0;
            padding: 5px;
            font-size: 16px;
            font-weight: bold;
        }
        .voucher .details {
            font-size: 12px;
        }
        @media print {
            .no-print {
                display: none;
            }
            .vouchers {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="header no-print">WiFi Voucher Printer</h1>
    <form action="" method="post" enctype="multipart/form-data" class="no-print">
        <label for="csv_file">Upload CSV File:</label>
        <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
        <button type="submit" name="upload">Upload and Generate</button>
    </form>

    <?php
    if (isset($_POST['upload'])) {
        if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['csv_file']['tmp_name'];
            $csvData = array_map('str_getcsv', file($fileTmpPath));

            echo '<div class="vouchers">';

            foreach ($csvData as $index => $row) {
                if (isset($row[0])) {
                    echo '<div class="voucher">';
                    echo '<h2>Ellry Cafe WiFi Voucher</h2>';
                    echo '<div class="password">' . htmlspecialchars($row[0]) . '</div>';
                    echo '<div class="details">WiFi: Ellry Cafe<br>Pass: Ellrycafe<br>Free 3 hours</div>';
                    echo '</div>';
                }
            }

            echo '</div>';
            echo '<button class="no-print" onclick="window.print()">Print Vouchers</button>';
        } else {
            echo '<p style="color: red;">There was an error uploading the file. Please try again.</p>';
        }
    }
    ?>
</div>
</body>
</html>
