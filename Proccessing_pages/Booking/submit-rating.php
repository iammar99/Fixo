<?php
session_start();
require_once __DIR__ . "/../../includes/db/database.php";
require_once __DIR__ . "/../../Config/config.php";


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

// Check if required fields are provided
if (!isset($_POST['booking_id']) || !isset($_POST['provider_id']) || !isset($_POST['rating'])) {
    $_SESSION['error'] = "Missing required information.";
    header("Location: " . BASE_URL . "trackBooking.php");
    exit();
}

$booking_id = intval($_POST['booking_id']);
$provider_id = intval($_POST['provider_id']);
$rating = intval($_POST['rating']);
$client_id = $_SESSION['user']['id'] ?? 0;

// Validate rating
if ($rating < 1 || $rating > 5) {
    $_SESSION['error'] = "Invalid rating value.";
    header("Location: " . BASE_URL . "trackBooking.php");
    exit();
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    // Check if booking belongs to this client and is completed
    $check_query = "SELECT id FROM bookings WHERE id = :booking_id AND client_id = :client_id AND provider_id = :provider_id AND status = 'completed'";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindParam(":booking_id", $booking_id);
    $check_stmt->bindParam(":client_id", $client_id);
    $check_stmt->bindParam(":provider_id", $provider_id);
    $check_stmt->execute();
    
    if ($check_stmt->rowCount() === 0) {
        $_SESSION['error'] = "Booking not found or cannot be rated.";
        header("Location: " . BASE_URL . "trackBooking.php");
        exit();
    }
    
    // Update provider rating (average calculation)
    // First, get current rating and count
    $current_query = "SELECT rating FROM providers WHERE id = :provider_id";
    $current_stmt = $db->prepare($current_query);
    $current_stmt->bindParam(":provider_id", $provider_id);
    $current_stmt->execute();
    $provider = $current_stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($provider) {
        $current_rating = floatval($provider['rating']);
        
        // For simplicity, we'll just set the rating directly
        // In a real app, you might want to calculate average from multiple ratings
        $update_query = "UPDATE providers SET rating = :rating WHERE id = :provider_id";
        $update_stmt = $db->prepare($update_query);
        $update_stmt->bindParam(":rating", $rating, PDO::PARAM_STR);
        $update_stmt->bindParam(":provider_id", $provider_id);
        
        if ($update_stmt->execute()) {
            $_SESSION['success'] = "Rating submitted successfully.";
        } else {
            $_SESSION['error'] = "Failed to submit rating. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Provider not found.";
    }
    
} catch (PDOException $e) {
    error_log("Error submitting rating: " . $e->getMessage());
    $_SESSION['error'] = "An error occurred. Please try again.";
}

header("Location: " . BASE_URL . "trackBooking.php");
exit();
?>