<?php
session_start();
require_once "../../Config/config.php";
require_once "../../includes/db/database.php";



// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: " . BASE_URL . "bookings.php");
    exit();
}

// Get form data
$booking_id = $_POST["booking_id"] ?? 0;
$new_status = $_POST["status"] ?? '';

// Validate input
if (empty($booking_id) || empty($new_status)) {
    $_SESSION["error_message"] = ["Missing required fields"];
    header("Location: " . BASE_URL . "bookings.php");
    exit();
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    // Check if booking belongs to this provider
    $checkQuery = "SELECT provider_id FROM bookings WHERE id = :booking_id";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bindParam(":booking_id", $booking_id, PDO::PARAM_INT);
    $checkStmt->execute();
    $booking = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$booking || $booking['provider_id'] != $_SESSION["user"]["id"]) {
        $_SESSION["error_message"] = ["Unauthorized access"];
        header("Location: " . BASE_URL . "bookings.php");
        exit();
    }
    
    // Update booking status
    $query = "UPDATE bookings SET status = :status, updated_at = NOW() WHERE id = :booking_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":status", $new_status, PDO::PARAM_STR);
    $stmt->bindParam(":booking_id", $booking_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $_SESSION["success_message"] = "Booking status updated successfully!";
        
        // Update provider availability if needed
        if ($new_status == 'in_progress') {
            $updateProvider = "UPDATE providers SET availability = 'busy' WHERE id = :provider_id";
            $updateStmt = $db->prepare($updateProvider);
            $updateStmt->bindParam(":provider_id", $_SESSION["user"]["id"], PDO::PARAM_INT);
            $updateStmt->execute();
        }else if ($new_status == 'completed' || $new_status == "cancelled") {
            $updateProvider = "UPDATE providers SET availability = 'available' WHERE id = :provider_id";
            $updateStmt = $db->prepare($updateProvider);
            $updateStmt->bindParam(":provider_id", $_SESSION["user"]["id"], PDO::PARAM_INT);
            $updateStmt->execute();
        } 
        
    } else {
        $errorInfo = $stmt->errorInfo();
        $_SESSION["error_message"] = ["Database error: " . $errorInfo[2]];
    }
    
} catch (Exception $e) {
    $_SESSION["error_message"] = ["Server error: " . $e->getMessage()];
}

// Redirect back to bookings page
header("Location: " . BASE_URL . "bookings.php");
exit();
?>