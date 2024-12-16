<?php
// adoption.php logic at the top
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email and phone format
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // Email validation 
    $email_pattern = "/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,6}$/";
    // Phone number validation 
    $phone_pattern = "/^\d{10}$/";
    
    if (!preg_match($email_pattern, $email)) {
        echo "Invalid email format. Please enter a valid email address.";
    } elseif (!preg_match($phone_pattern, $phone)) {
        echo "Invalid phone number format. Please enter a 10-digit phone number.";
    } else {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'pet_adoption'); 
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve  data
        $pet_id = $_POST['pet_id'];
        $name = $_POST['name'];

        // Insert data 
        $stmt = $conn->prepare("INSERT INTO adoption_requests (pet_id, name, email, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $pet_id, $name, $email, $phone);

        if ($stmt->execute()) {
            echo "Adoption request submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-yellow-100 text-gray-800">

    <div class="container mx-auto px-4 py-16">
        <h2 class="text-2xl font-bold text-yellow-800 mb-4">Adopt a Pet</h2>
        <form action="" method="post">
            <input type="hidden" name="pet_id" value="<?php echo $_GET['pet_id']; ?>" />

            <label for="name" class="block text-yellow-800 font-semibold">Your Name:</label>
            <input type="text" id="name" name="name" required class="w-full px-4 py-2 mb-4 border border-gray-300 rounded">

            <label for="email" class="block text-yellow-800 font-semibold">Email:</label>
            <input type="email" id="email" name="email" required class="w-full px-4 py-2 mb-4 border border-gray-300 rounded">

            <label for="phone" class="block text-yellow-800 font-semibold">Phone:</label>
            <input type="tel" id="phone" name="phone" required class="w-full px-4 py-2 mb-4 border border-gray-300 rounded">

            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Submit Adoption Request</button>
        </form>
    </div>

</body>
</html>
