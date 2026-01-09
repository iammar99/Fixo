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

// Check if booking_id is provided
if (!isset($_POST['booking_id']) || empty($_POST['booking_id'])) {
    $_SESSION['error'] = "No booking specified.";
    header("Location: " . BASE_URL . "trackBooking.php");
    exit();
}

$booking_id = intval($_POST['booking_id']);
$client_id = $_SESSION['user']['id'] ?? 0;

try {
    $database = new Database();
    $db = $database->getConnection();
    
    // Check if booking belongs to this client and is completed or cancelled
    $check_query = "SELECT id FROM bookings WHERE id = :booking_id AND client_id = :client_id AND status IN ('completed', 'cancelled')";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindParam(":booking_id", $booking_id);
    $check_stmt->bindParam(":client_id", $client_id);
    $check_stmt->execute();
    
    if ($check_stmt->rowCount() === 0) {
        $_SESSION['error'] = "Booking not found or cannot be deleted.";
        header("Location: " . BASE_URL . "trackBooking.php");
        exit();
    }
    
    // Delete booking
    $delete_query = "DELETE FROM bookings WHERE id = :booking_id";
    $delete_stmt = $db->prepare($delete_query);
    $delete_stmt->bindParam(":booking_id", $booking_id);
    
    if ($delete_stmt->execute()) {
        $_SESSION['success'] = "Booking deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete booking. Please try again.";
    }
    
} catch (PDOException $e) {
    error_log("Error deleting booking: " . $e->getMessage());
    $_SESSION['error'] = "An error occurred. Please try again.";
}

header("Location: " . BASE_URL . "trackBooking.php");
exit();
?>