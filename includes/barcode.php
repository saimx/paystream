<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1); 

// Trigger an error



?>
<?php


function generateBarcode($code) {
    $width = 200;
    $height = 100;
    $image = imagecreate($width, $height);
    $backgroundColor = imagecolorallocate($image, 255, 255, 255);
    $barColor = imagecolorallocate($image, 0, 0, 0);

    // Draw the barcode (simple representation)
    $barWidth = 2;
    for ($i = 0; $i < strlen($code); $i++) {
        if ($code[$i] == '1') {
            imagefilledrectangle($image, $i * $barWidth, 0, ($i + 1) * $barWidth - 1, $height, $barColor);
        }
    }

    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
}

// Example usage
generateBarcode("10101010101010101010"); // Replace with your barcode data
