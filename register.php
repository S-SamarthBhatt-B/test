<?php
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "user_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check for existing username, email, or phone number
    $check_query = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ? OR phone_number = ?");
    $check_query->bind_param("sss", $username, $email, $phone_number);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "Username, Email, or Phone Number already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone_number, username, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $email, $phone_number, $username, $password);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_query->close();
}

$conn->close();
?>
