<?php
// Fungsi enkripsi Vigenere Cipher
function vigenereEncrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $encryptedText = '';
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        // Abaikan karakter non-huruf
        if (!ctype_alpha($char)) {
            $encryptedText .= $char;
            continue;
        }

        // Hitung karakter baru berdasarkan Vigenere Cipher
        $charOffset = ord($char) - 65;
        $keyCharOffset = ord($key[$keyIndex % $keyLength]) - 65;
        $encryptedChar = chr((($charOffset + $keyCharOffset) % 26) + 65);

        $encryptedText .= $encryptedChar;
        $keyIndex++;
    }

    return $encryptedText;
}

// Fungsi dekripsi Vigenere Cipher
function vigenereDecrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $decryptedText = '';
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        // Abaikan karakter non-huruf
        if (!ctype_alpha($char)) {
            $decryptedText .= $char;
            continue;
        }

        // Hitung karakter asli berdasarkan Vigenere Cipher
        $charOffset = ord($char) - 65;
        $keyCharOffset = ord($key[$keyIndex % $keyLength]) - 65;
        $decryptedChar = chr(((($charOffset - $keyCharOffset) + 26) % 26) + 65);

        $decryptedText .= $decryptedChar;
        $keyIndex++;
    }

    return $decryptedText;
}

// Inisialisasi variabel
$text = "";
$key = "DEVINA"; // Kunci enkripsi/dekripsi yang ditetapkan
$encryptedText = "";
$decryptedText = "";
$operation = "encrypt"; // Default operasi adalah enkripsi

// Memproses input saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $operation = $_POST["operation"];

    if ($operation == "encrypt") {
        $encryptedText = vigenereEncrypt($text, $key);
    } elseif ($operation == "decrypt") {
        $decryptedText = vigenereDecrypt($text, $key);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher - Green Theme</title>
    <style>
        body {
            background-color: #e0f7fa;  /* Light green background */
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
            color: #4caf50; /* Green */
        }

        textarea, input[type="text"], input[type="radio"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: none;
            border-radius: 10px;
            background-color: #e8f5e9; /* Very light green */
            color: #2e7d32;
            font-size: 16px;
        }

        .radio-inline {
            display: inline-block;
            margin-right: 20px;
        }

        .radio-inline label {
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
            background-color: #81c784; /* Light green */
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #66bb6a; /* Darker green */
        }

        .result {
            background-color: #a5d6a7; /* Soft green */
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            text-align: center;
            color: #2e7d32;
            font-weight: bold;
            font-size: 18px;
            word-wrap: break-word;
            word-break: break-all;
        }

        .btn-secondary {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 10px;
            background-color: #aed581; /* Light green-yellow */
            color: #fff;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #9ccc65; /* Darker green-yellow */
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
        <h1>Vigenere Cipher</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="text">Masukkan teks:</label>
                <input type="text" class="form-control" name="text" id="text" value="<?php echo htmlspecialchars($text); ?>">
            </div>
            <div class="form-group">
                <label class="radio-inline">
                    <input type="radio" name="operation" value="encrypt" <?php if ($operation == "encrypt") echo "checked"; ?>> Enkripsi
                </label>
                <label class="radio-inline">
                    <input type="radio" name="operation" value="decrypt" <?php if ($operation == "decrypt") echo "checked"; ?>> Dekripsi
                </label>
            </div>
            <button type="submit" class="btn-primary">Proses</button>
        </form>

        <?php if (!empty($encryptedText) || !empty($decryptedText)): ?>
            <div class="result">
                <?php if ($operation == "encrypt"): ?>
                    <h2>Hasil Enkripsi</h2>
                    <p>Input: <?php echo htmlspecialchars($text); ?></p>
                    <p>Output: <?php echo htmlspecialchars($encryptedText); ?></p>
                <?php elseif ($operation == "decrypt"): ?>
                    <h2>Hasil Dekripsi</h2>
                    <p>Input: <?php echo htmlspecialchars($text); ?></p>
                    <p>Output: <?php echo htmlspecialchars($decryptedText); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <a href="Caesar.php"><button class="btn-secondary">Enkripsi Tahap Pertama</button></a>
    </div>
</body>
</html>
