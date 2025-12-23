<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../Config/config.php";
require_once "../../includes/db/database.php";

// Check if user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    $_SESSION["error_message"] = ["Please login to book a mechanic"];
    header("Location: " . BASE_URL . "login.php");
    exit();
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $_SESSION["error_message"] = ["Invalid request method"];
    header("Location: " . BASE_URL . "dashboard.php");
    exit();
}

// Get form data
$client_id = $_SESSION["user"]["id"] ?? 0;
$mechanic_id = $_POST["mechanicId"] ?? 0;
$mechanic_name = $_POST["mechanicName"] ?? '';
$mechanic_phone = $_POST["mechanicPhone"] ?? '';
$problem_type = $_POST["problemType"] ?? '';
$problem_description = $_POST["problemDescription"] ?? '';

// Validate input
$errors = [];

if (empty($client_id) || $client_id == 0) {
    $errors[] = "Client ID is missing";
}

if (empty($mechanic_id) || $mechanic_id == 0) {
    $errors[] = "Mechanic ID is required";
}

if (empty($mechanic_name)) {
    $errors[] = "Mechanic name is required";
}

if (empty($mechanic_phone)) {
    $errors[] = "Mechanic phone is required";
}

if (empty($problem_type)) {
    $errors[] = "Please select a problem type";
}

if (empty($problem_description)) {
    $errors[] = "Please describe the problem";
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION["error_message"] = $errors;
    $_SESSION["old_form_data"] = $_POST;
    header("Location: " . BASE_URL . "dashboard.php");
    exit();
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    // Insert booking into database
    $query = "INSERT INTO bookings 
              (client_id, provider_id, problem_type, problem_description, status, created_at) 
              VALUES 
              (:client_id, :provider_id, :problem_type, :problem_description, 'pending', NOW())";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
    $stmt->bindParam(":provider_id", $mechanic_id, PDO::PARAM_INT);
    $stmt->bindParam(":problem_type", $problem_type, PDO::PARAM_STR);
    $stmt->bindParam(":problem_description", $problem_description, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        // Get booking ID
        $booking_id = $db->lastInsertId();
        
        // Update mechanic availability to 'busy' (optional)
        $updateQuery = "UPDATE providers SET availability = 'busy' WHERE id = :mechanic_id";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindParam(":mechanic_id", $mechanic_id, PDO::PARAM_INT);
        $updateStmt->execute();
        
        // Set success message
        $_SESSION["success_message"] = "Booking created successfully! Booking ID: #" . $booking_id;
        
        // Redirect to dashboard
        header("Location: " . BASE_URL . "dashboard.php");
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        $_SESSION["error_message"] = ["Database error: " . $errorInfo[2]];
        $_SESSION["old_form_data"] = $_POST;
        header("Location: " . BASE_URL . "dashboard.php");
        exit();
    }
    
} catch (Exception $e) {
    $_SESSION["error_message"] = ["Server error: " . $e->getMessage()];
    $_SESSION["old_form_data"] = $_POST;
    header("Location: " . BASE_URL . "dashboard.php");
    exit();
}
?>