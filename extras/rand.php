<?php
// Array of random Pakistani names for testing purposes
$names = [
    "Ali Ahmed", "Fatima Noor", "Hassan Raza", "Ayesha Khan", "Zainab Bibi", "Usman Ali",
    "Maryam Tariq", "Abdullah Sheikh", "Sara Zafar", "Hamza Khan", "Sana Malik", "Bilal Ashraf",
    "Mahnoor Anwar", "Zara Latif", "Raza Aslam", "Umar Farooq", "Hina Yousuf", "Ibrahim Zaid",
    "Khadija Saeed", "Adeel Hussain", "Shan Malik", "Taha Ahmed", "Farah Shaikh", "Yasir Iqbal",
    "Samreen Anjum", "Waseem Akhtar", "Rabia Saleem", "Ahmed Zubair"
];

// Generate unique ID card numbers
function generateUniqueIdCard($existingIdCards) {
    do {
        $id_card = rand(1000000000000, 9999999999999);
    } while (in_array($id_card, $existingIdCards)); // Ensure no duplicates
    return $id_card;
}

// Function to generate random data
function generateRandomCustomer($id, &$existingEmails, &$existingIdCards) {
    global $names;

    // Random name selection
    $name = $names[array_rand($names)];

    // Generate a unique email
    do {
        $email = strtolower(str_replace(' ', '', $name)) . rand(1000, 9999) . "@gmail.com";
    } while (in_array($email, $existingEmails));
    $existingEmails[] = $email;

    // Random phone number
    $phone = "9233" . rand(10000000, 99999999);

    // Random address
    $address = rand(1, 1000) . " " . $name . " Street, Lahore";

    // Generate unique ID card number
    $id_card = generateUniqueIdCard($existingIdCards);
    $existingIdCards[] = $id_card;

    // Random next of kin
    $next_of_kin = $names[array_rand($names)];

    // Random second phone number
    $phone2 = "0333" . rand(1000000, 9999999);

    // Generate unique next of kin ID card
    $next_of_kin_id_card = generateUniqueIdCard($existingIdCards);
    $existingIdCards[] = $next_of_kin_id_card;

    // Random relationship
    $relationship = rand(0, 1) ? "Wife" : "Husband";

    // Random photo path using randomuser API
    $photo_path = "https://api.randomuser.me/portraits/men/" . rand(1, 99) . ".jpg";
    $id_card_front = "documents/3650244262337/front-side.jpg";
    $id_card_back = "documents/3650244262337/back-side.jpg";
    $next_of_kin_id_card_front = "documents/3650244262337/NOK-front-side.jpg";
    $next_of_kin_id_card_back = "documents/3650244262337/NOK-back-side.jpg";

    // Created by
    $created_by = "Admin";

    // Random created_at date
    $created_at = date("Y-m-d H:i:s", strtotime("-" . rand(1, 30) . " days"));

    // Return SQL insertion string
    return "($id, '$name', '$email', '$phone', '$address', '$id_card', '$next_of_kin', '$phone2', '$next_of_kin_id_card', '$relationship', '$photo_path', '$id_card_front', '$id_card_back', '$next_of_kin_id_card_front', '$next_of_kin_id_card_back', '$created_by', '$created_at')";
}

// Arrays to track existing emails and ID cards
$existingEmails = [];
$existingIdCards = [];

// Generate 100 customers
for ($i = 1; $i <= 100; $i++) {
    $customer = generateRandomCustomer($i, $existingEmails, $existingIdCards);
    echo "INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `id_card`, `next_of_kin`, `phone2`, `next_of_kin_id_card`, `relationship`, `photo_path`, `id_card_front`, `id_card_back`, `next_of_kin_id_card_front`, `next_of_kin_id_card_back`, `created_by`, `created_at`) VALUES\n";
    echo $customer . ";\n";
}
?>
