<?php

// Autoloader for Barcode classes
spl_autoload_register(function ($class) {
    $prefix = 'Picqer\\Barcode\\';  // Namespace prefix for the library
    $base_dir = __DIR__ . '/barcode/';  // Base directory for the namespace prefix

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

// Include the necessary Barcode class
require_once '../includes/barcode/BarcodeGeneratorHTML.php';
$data= isset($_GET['data']) ? intval($_GET['data']) : 0;



// Generate the barcode
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
$barcodePNG = $generatorPNG->getBarcode($data, $generatorPNG::TYPE_CODE_128);

// Set the appropriate headers for image output
header('Content-Type: image/png');

// Output the barcode PNG
echo $barcodePNG;

?>
