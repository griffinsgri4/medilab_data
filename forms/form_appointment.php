<?php
// Database configuration
$servername = "localhost";
$username = "root";  // Adjust accordingly
$password = "";  // Adjust accordingly
$dbname = "vebeneza_medical_center";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, appointment_date, department_id, doctor_id, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $phone, $appointment_date, $department_id, $doctor_id, $message);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$appointment_date = $_POST['date'];
$department_name = $_POST['department'];
$doctor_name = $_POST['doctor'];
$message = $_POST['message'];

// Get department ID
$dept_result = $conn->query("SELECT id FROM departments WHERE name = '$department_name'");
$dept_row = $dept_result->fetch_assoc();
$department_id = $dept_row['id'];

// Get doctor ID
$doc_result = $conn->query("SELECT id FROM doctors WHERE name = '$doctor_name'");
$doc_row = $doc_result->fetch_assoc();
$doctor_id = $doc_row['id'];

// Execute the statement
if ($stmt->execute()) {
    echo "New appointment request submitted successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
