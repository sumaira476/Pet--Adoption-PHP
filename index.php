<?php
// Database connection variables
$host = 'localhost';
$db = 'pet_adoption';
$user = 'root';
$pass = '';

// Create a new database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

  
    $stmt->bind_param("sss", $name, $email, $message);



    // Insert form data into the contacts table
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thank you for contacting us! We will get back to you soon.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pet Adoption</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body class="bg-yellow-100 text-gray-800">
    <!-- Navbar -->
    <header class="bg-yellow-300 shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-yellow-800">Pawfect
            </h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="#home" class="hover:text-yellow-800">Home</a></li>
                    <li><a href="#about" class="hover:text-yellow-800">About Us</a></li>
                    <li><a href="#pets" class="hover:text-yellow-800">Available Pets</a></li>
                    <li><a href="#testimonials" class="hover:text-yellow-800">Testimonials</a></li>
                    <li><a href="#contact" class="hover:text-yellow-800">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Home Section -->
    <section id="home" class="bg-yellow-200 h-96 flex items-center justify-center" style="background-size: cover;">
        <div class="bg-yellow-800 bg-opacity-50 p-10 rounded-lg text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Find Your Perfect Pet</h2>
            <p class="text-white">Join Pawfect and find the perfect companion!</p>
            <a href="#contact" class="mt-4 inline-block bg-yellow-600 text-white px-4 py-2 rounded">Get in Touch</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="container mx-auto px-4 py-16">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-yellow-800">About Us</h2>
            <p class="text-gray-700">Dedicated to connecting people with loving pets.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="flex items-center">
                <img src="https://www.aspca.org/sites/default/files/how-you-can-help_adoptions-tips_main-image-dog.jpg" alt="Our Team" class="rounded-lg shadow-lg" />
            </div>
            <div class="flex flex-col justify-center">
                <p class="text-gray-700">
                At Pawfect, we believe that every pet deserves a loving, forever home. Our mission is to bring together compassionate individuals and wonderful animals who are in need of a second chance. We understand the deep bond between humans and animals, and we work tirelessly to ensure 
                that each pet we rescue finds a family who will care for them
                 as much as they care for their new family members. Whether you're adopting your first pet or adding to your family, we’re here to support you through every step of the journey. With each adoption, we’re not just changing the life of an animal; we’re changing the hearts of families. Join us in giving these pets the love and care they deserve, and let’s create happy tails together.
                </p>
            </div>
        </div>
    </section>

    <!-- Available Pets Section -->
    <section id="pets" class="bg-yellow-300 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-bold text-yellow-800 mb-4">Available Pets</h2>
            <p class="text-gray-700 mb-8">Meet some of our adorable pets looking for a home!</p>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Load available pets dynamically from display.php -->
                <?php include 'display.php'; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="container mx-auto px-4 py-16">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-yellow-800">Testimonials</h2>
            <p class="text-gray-700">What our happy adopters are saying about us!</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-yellow-50 rounded-lg shadow-lg p-6">
                <p class="text-gray-700">"Adopting Buddy was the best decision! He's brought so much joy to our family."</p>
                <p class="text-yellow-800 font-semibold mt-2">- Sarah J.</p>
            </div>
            <div class="bg-yellow-50 rounded-lg shadow-lg p-6">
                <p class="text-gray-700">"The team was incredibly helpful in finding the right pet for me. Max is my best friend!"</p>
                <p class="text-yellow-800 font-semibold mt-2">- Michael T.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="bg-yellow-200 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-bold text-yellow-800 mb-4">Contact Us</h2>
            <p class="text-gray-700 mb-8">Have questions? Reach out to us for more information!</p>
            <form class="max-w-md mx-auto" id="contactForm" method="POST" action="index.php">
                <input type="text" name="name" placeholder="Your Name" class="w-full px-4 py-2 mb-4 border border-gray-300 rounded" required />
                <input type="email" name="email" placeholder="Your Email" class="w-full px-4 py-2 mb-4 border border-gray-300 rounded" required />
                <textarea name="message" placeholder="Your Message" class="w-full px-4 py-2 mb-4 border border-gray-300 rounded" required></textarea>
                <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Submit</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-yellow-300 text-gray-800 py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2023 Pet Adoption. All rights reserved.</p>
            <p class="text-sm text-yellow-800">Made with ❤️ by our team.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
