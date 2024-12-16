<?php
// display.php
include 'config.php'; // Ensure config.php contains the database connection setup

// Fetch pets data from the database
$sql = "SELECT * FROM pets";
$result = $conn->query($sql);

if ($result-> num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="bg-white rounded-lg shadow-lg p-6">';
        echo '<img src="' . $row['image_path'] . '" alt="Pet" class="rounded w-full mb-4">';
        echo '<h3 class="text-lg font-semibold text-yellow-800">' . htmlspecialchars($row['name']) . '</h3>';
        echo '<p class="text-gray-700">' . htmlspecialchars($row['description']) . '</p>';
        
        // Adopt and Like buttons
        echo '<div class="mt-4 flex justify-between items-center">';
        echo '<a href="adopt_form.php?pet_id=' . $row['id'] . '" class="adopt-button bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Adopt</a>';
        echo '<button class="like-button text-gray-700 px-4 py-2 rounded hover:text-red-500" onclick="toggleLike(this)">
                <i class="heart-icon">&#x2764;</i> Like
              </button>';
        echo '</div>';

        echo '</div>';
    }
} else {
    echo "<p class='text-yellow-800'>No pets are currently available.</p>";
}

$conn->close();
?>
