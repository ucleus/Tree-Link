<?php
// This script handles the creation of a vCard (.vcf) file to share contact information.
// Make sure to place this file in a PHP-enabled server environment.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve POST data from the form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $webAddress = $_POST['webAddress'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $facebook = $_POST['facebook'];

    // Initialize vCard string
    $vcard = "BEGIN:VCARD\n";
    $vcard .= "VERSION:3.0\n";
    $vcard .= "FN:{$firstName} {$lastName}\n";
    $vcard .= "TEL;TYPE=CELL:{$phoneNumber}\n";
    $vcard .= "EMAIL:{$email}\n";
    $vcard .= "URL:{$webAddress}\n";
    $vcard .= "X-INSTAGRAM:{$instagram}\n";
    $vcard .= "X-TWITTER:{$twitter}\n";
    $vcard .= "X-LINKEDIN:{$linkedin}\n";
    $vcard .= "X-FACEBOOK:{$facebook}\n";

    // Check if a photo was uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photoPath = $_FILES['photo']['tmp_name'];
        $photoData = base64_encode(file_get_contents($photoPath));
        $vcard .= "PHOTO;ENCODING=BASE64;JPEG:{$photoData}\n";
    }

    $vcard .= "END:VCARD";

    // Set headers to download the vCard file
    header('Content-Type: text/vcard');
    header('Content-Disposition: attachment; filename="contact.vcf"');
    echo $vcard;
    exit;
}
?>

<!-- HTML Form to collect contact information -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Card Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-3xl font-bold text-center mb-6">Contact Card Generator</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">First Name:</label>
                <input type="text" name="firstName" required class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Last Name:</label>
                <input type="text" name="lastName" required class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Phone Number:</label>
                <input type="text" name="phoneNumber" required class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email:</label>
                <input type="email" name="email" required class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Web Address:</label>
                <input type="url" name="webAddress" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Instagram:</label>
                <input type="text" name="instagram" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Twitter:</label>
                <input type="text" name="twitter" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">LinkedIn:</label>
                <input type="text" name="linkedin" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Facebook:</label>
                <input type="text" name="facebook" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Photo (400x400px):</label>
                <input type="file" name="photo" accept="image/*" class="w-full p-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="text-center">
                <button type="submit" class="w-full py-3 mt-4 bg-indigo-600 hover:bg-indigo-700 rounded text-white font-bold">Generate Contact Card</button>
            </div>
        </form>
    </div>
</body>
</html>
