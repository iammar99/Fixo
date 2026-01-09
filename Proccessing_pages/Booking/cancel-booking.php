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
    
    // Check if booking belongs to this client and is still pending
    $check_query = "SELECT id, provider_id FROM bookings WHERE id = :booking_id AND client_id = :client_id AND status = 'pending'";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindParam(":booking_id", $booking_id);
    $check_stmt->bindParam(":client_id", $client_id);
    $check_stmt->execute();
    $booking = $check_stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$booking) {
        $_SESSION['error'] = "Booking not found or cannot be cancelled.";
        header("Location: " . BASE_URL . "trackBooking.php");
        exit();
    }
    
    // Start transaction to ensure both updates succeed
    $db->beginTransaction();
    
    try {
        // Update booking status to cancelled
        $update_query = "UPDATE bookings SET status = 'cancelled' WHERE id = :booking_id";
        $update_stmt = $db->prepare($update_query);
        $update_stmt->bindParam(":booking_id", $booking_id);
        
        if (!$update_stmt->execute()) {
            throw new Exception("Failed to cancel booking.");
        }
        
        // Update provider status to available
        if (!empty($booking['provider_id'])) {
            $updateProvider = "UPDATE providers SET availability = 'available' WHERE id = :provider_id";
            $updateStmt = $db->prepare($updateProvider);
            $updateStmt->bindParam(":provider_id", $booking['provider_id'], PDO::PARAM_INT);
            
            if (!$updateStmt->execute()) {
                throw new Exception("Failed to update provider status.");
            }
        }
        
        // Commit transaction
        $db->commit();
        $_SESSION['success'] = "Booking cancelled successfully and provider status updated.";
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $db->rollBack();
        $_SESSION['error'] = $e->getMessage();
    }
    
} catch (PDOException $e) {
    error_log("Error cancelling booking: " . $e->getMessage());
    $_SESSION['error'] = "An error occurred. Please try again.";
}

header("Location: " . BASE_URL . "trackBooking.php");
exit();
?>