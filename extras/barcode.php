<?php
// Include the necessary classes
spl_autoload_register(function ($class) {
    $prefix = 'Picqer\\Barcode\\';  // Namespace prefix for the library
    $base_dir = __DIR__ . '/../includes/barcode/';  // Base directory for the namespace prefix

    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // If not, move to the next registered autoloader
        return;
    }

    // Get the relative class name
    $relative_class = substr($class, $len);

    // Replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators, and append with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});






// Receipt Data
$receiptNumber = '1234567890'; // Example receipt number
$amount = 100.50; // Example amount

// Generate Barcode in HTML format
$generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
$barcodeHTML = $generatorHTML->getBarcode($receiptNumber, $generatorHTML::TYPE_CODE_128);

// Generate Barcode in PNG format
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
$barcodePNG = $generatorPNG->getBarcode($receiptNumber, $generatorPNG::TYPE_CODE_128);

// Save PNG Barcode to a file
file_put_contents('barcode.png', $barcodePNG);

// Display the receipt
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .receipt {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .barcode {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Receipt</h1>
        <p><strong>Receipt Number:</strong> <?= $receiptNumber ?></p>
        <p><strong>Amount Paid:</strong> $<?= number_format($amount, 2) ?></p>
        <div class="barcode">
            <h3>Scan for Receipt</h3>
            <!-- Display the barcode in HTML format -->
            <?= $barcodeHTML ?>
        </div>
    </div>
</body>
</html>
