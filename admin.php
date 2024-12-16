<?php
// admin.php
include 'config.php'; // Make sure config.php has your DB connection details

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 500 KB)
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if all conditions are met before uploading
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Prepare SQL statement to insert data
            $stmt = $conn->prepare("INSERT INTO pets (name, description, image_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $description, $target_file);
            $stmt->execute();

            echo "Pet uploaded successfully!";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Upload Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-yellow-100 text-gray-800">

    <div class="container mx-auto px-4 py-16">
        <h2 class="text-2xl font-bold text-yellow-800 mb-4">Upload Pet Details</h2>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <label for="name" class="block text-yellow-800 font-semibold">Pet Name:</label>
            <input type="text" id="name" name="name" required class="w-full px-4 py-2 mb-4 border border-gray-300 rounded">

            <label for="description" class="block text-yellow-800 font-semibold">Description:</label>
            <textarea id="description" name="description" required class="w-full px-4 py-2 mb-4 border border-gray-300 rounded"></textarea>

            <label for="image" class="block text-yellow-800 font-semibold">Upload Image:</label>
            <input type="file" id="image" name="image" required class="w-full mb-4 border border-gray-300 rounded">

            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Upload Pet</button>
        </form>
    </div>

</body>
</html>
