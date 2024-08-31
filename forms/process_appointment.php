<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize form inputs
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$appointment_message = $conn->real_escape_string($_POST['appointment_message']);
$selected_doctor = $conn->real_escape_string($_POST['selected_doctor']);
$department = $conn->real_escape_string($_POST['department']);

// Prepare and execute SQL query
$sql = "INSERT INTO appointments (username, email, appointment_message, selected_doctor, department)
        VALUES ('$username', '$email', '$appointment_message', '$selected_doctor', '$department')";

if ($conn->query($sql) === TRUE) {
    echo "New appointment request submitted successfully";
    // Optionally send an email notification
    $to = $email;
    $subject = "Appointment Confirmation";
    $message = "Dear $username,\n\nThank you for scheduling an appointment with Dr. $selected_doctor in the $department department. We have received your message:\n\n$appointment_message\n\nBest regards,\nYour Clinic";
    $headers = "From: no-reply@yourclinic.com";

    mail($to, $subject, $message, $headers);

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
