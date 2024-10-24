<?php
// Tabel substitusi karakter berdasarkan nama "Erista"
$encryptionTable = [
    'A' => 'E', 'B' => 'R', 'C' => 'I', 'D' => 'S', 'E' => 'T', 'F' => 'A',
    'G' => 'B', 'H' => 'C', 'I' => 'D', 'J' => 'F', 'K' => 'G', 'L' => 'H',
    'M' => 'J', 'N' => 'K', 'O' => 'L', 'P' => 'M', 'Q' => 'N', 'R' => 'O',
    'S' => 'P', 'T' => 'Q', 'U' => 'U', 'V' => 'V', 'W' => 'W', 'X' => 'X',
    'Y' => 'Y', 'Z' => 'Z'
];

// Fungsi enkripsi dan dekripsi
function encryptText($text, $table) {
    $encryptedText = "";
    $text = strtoupper($text);
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        $encryptedText .= $table[$char] ?? $char;
    }
    return $encryptedText;
}

function decryptText($text, $table) {
    $decryptedText = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        $decryptedText .= array_search($char, $table) ?? $char;
    }
    return $decryptedText;
}

// Handling form submission
$text = "";
$processedText = "";
$operation = "encrypt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $operation = $_POST["operation"];

    if ($operation == "encrypt") {
        $processedText = encryptText($text, $encryptionTable);
    } else {
        $processedText = decryptText($text, $encryptionTable);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandi Caesar - Tabel Erista</title>
    <style>
        body {
            background-color: #e0f7fa;  /* Latar belakang hijau muda */
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #2e7d32;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4caf50; /* Hijau */
        }

        textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            background-color: #e8f5e9; /* Hijau sangat muda */
            color: #2e7d32;
            font-size: 16px;
            resize: none;
        }

        .radio-group {
            display: flex;
            justify-content: space-around;
            margin: 15px 0;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        input[type="radio"] {
            margin-right: 8px;
        }

        .btn-primary {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background-color: #81c784; /* Hijau muda */
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #66bb6a; /* Hijau yang lebih gelap */
        }

        .result {
            background-color: #a5d6a7; /* Hijau lembut */
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            text-align: center;
            color: #2e7d32;
            font-weight: bold;
            font-size: 18px;
            word-wrap: break-word; /* Memastikan teks terpotong dengan baik */
            word-break: break-word; /* Memastikan kata panjang tidak keluar */
            overflow-wrap: break-word; /* Tambahan untuk kompatibilitas */
        }

        .btn-secondary {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 10px;
            background-color: #aed581; /* Hijau-kuning muda */
            color: #fff;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #9ccc65; /* Hijau-kuning yang lebih gelap */
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #8e8e8e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sandi Caesar</h1>
        <form method="post" action="">
            <textarea name="text" rows="4" placeholder="Masukkan teks..."><?php echo htmlspecialchars($text); ?></textarea>
            <div class="radio-group">
                <label>
                    <input type="radio" name="operation" value="encrypt" <?php if ($operation == "encrypt") echo "checked"; ?>>
                    Enkripsi
                </label>
                <label>
                    <input type="radio" name="operation" value="decrypt" <?php if ($operation == "decrypt") echo "checked"; ?>>
                    Dekripsi
                </label>
            </div>
            <button type="submit" class="btn-primary">Proses</button>
        </form>

        <?php if (!empty($processedText)) : ?>
            <div class="result">
                <h2>Hasil:</h2>
                <p><?php echo nl2br(htmlspecialchars($processedText)); ?></p>
            </div>
        <?php endif; ?>

        <a href="vigenere.php" class="btn-secondary">Enkripsi Tahap Kedua</a>
    </div>
</body>
</html>
