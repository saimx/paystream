<?php
// Include the PHP QR Code library
include 'qrcode/qrlib.php'; // Adjust the path as necessary

// Get the dynamic ID from the request (e.g., from a GET parameter)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Create the URL with the dynamic ID

$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . 
              "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$parsedUrl = parse_url($currentUrl);
$baseUrl = $parsedUrl['scheme'] . "://" . $parsedUrl['host'];   

if (!empty($parsedUrl['path'])) {
    $pathParts = explode('/', trim($parsedUrl['path'], '/'));
    $baseUrl .= '/' . $pathParts[0];
}


$url = "$baseUrl/inventory-payment?id=" . $id;

// Generate the QR code and save it to a file
$filename = 'qrcode.png'; // You can change the filename as needed
QRcode::png($url, $filename, QR_ECLEVEL_L, 4);

// // Output the QR code image directly to the browser
header('Content-Type: image/png');
readfile($filename);

// // Optionally, delete the file after outputting it
// unlink($filename);
?>


