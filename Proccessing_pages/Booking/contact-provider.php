<?php
session_start();
require_once __DIR__ . "/../../includes/db/database.php";
require_once __DIR__ . "/../../Config/config.php";

// Check if user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

// Check if provider_id is provided
if (!isset($_POST['provider_id']) || empty($_POST['provider_id'])) {
    $_SESSION['error'] = "No provider specified.";
    header("Location: " . BASE_URL . "trackBooking/trackBooking-client-bookings.php");
    exit();
}

$provider_id = intval($_POST['provider_id']);
$client_id = $_SESSION['user']['id'] ?? 0;

try {
    $database = new Database();
    $db = $database->getConnection();
    
    // Verify that this client has a booking with this provider
    $check_query = "SELECT b.id FROM bookings b 
                    WHERE b.client_id = :client_id 
                    AND b.provider_id = :provider_id 
                    AND b.status NOT IN ('cancelled')";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindParam(":client_id", $client_id);
    $check_stmt->bindParam(":provider_id", $provider_id);
    $check_stmt->execute();
    
    if ($check_stmt->rowCount() === 0) {
        $_SESSION['error'] = "You don't have any active bookings with this provider.";
        header("Location: " . BASE_URL . "trackBooking.php");
        exit();
    }
    
    // Fetch provider details
    $query = "SELECT name, phone, email FROM providers WHERE id = :provider_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":provider_id", $provider_id);
    $stmt->execute();
    $provider = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($provider) {
        // Store provider contact info in session to show in modal on next page
        $_SESSION['provider_contact_info'] = [
            'name' => $provider['name'],
            'phone' => $provider['phone'],
            'email' => $provider['email']
        ];
        $_SESSION['success'] = "Provider contact information loaded.";
    } else {
        $_SESSION['error'] = "Provider not found.";
    }
    
} catch (PDOException $e) {
    error_log("Error fetching provider details: " . $e->getMessage());
    $_SESSION['error'] = "An error occurred. Please try again.";
}

header("Location: " . BASE_URL . "trackBooking.php");
exit();
?>