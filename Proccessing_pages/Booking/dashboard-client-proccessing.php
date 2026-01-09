<?php
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

try {
    $database = new Database();
    $db = $database->getConnection();

    $recent_bookings = [];

    if ($db) {
        $client_id = $_SESSION["user"]["id"];

        // Fetch bookings for this client with provider information
        $query = "SELECT b.*, p.name as provider_name, p.phone as provider_phone, 
                         p.email as provider_email, p.rating as provider_rating,
                         p.service, p.availability, c.name as client_name
                  FROM bookings b 
                  LEFT JOIN providers p ON b.provider_id = p.id 
                  LEFT JOIN clients c ON b.client_id = c.id
                  WHERE b.client_id = :client_id
                  ORDER BY b.created_at DESC";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":client_id", $client_id);
        $stmt->execute();
        $recent_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate counts for each status
        $status_counts = [
            'all' => count($recent_bookings),
            'pending' => count(array_filter($recent_bookings, function ($booking) {
                return $booking['status'] == 'pending';
            })),
            'accepted' => count(array_filter($recent_bookings, function ($booking) {
                return $booking['status'] == 'accepted';
            })),
            'in_progress' => count(array_filter($recent_bookings, function ($booking) {
                return $booking['status'] == 'in_progress';
            })),
            'completed' => count(array_filter($recent_bookings, function ($booking) {
                return $booking['status'] == 'completed';
            })),
            'cancelled' => count(array_filter($recent_bookings, function ($booking) {
                return $booking['status'] == 'cancelled';
            }))
        ];

        // Format data for display
        foreach ($recent_bookings as &$booking) {
            $booking['status_display'] = ucfirst(str_replace('_', ' ', $booking['status']));
            $booking['created_at_formatted'] = date('M d, Y \a\t h:i A', strtotime($booking['created_at']));
            $booking['updated_at_formatted'] = date('M d, Y \a\t h:i A', strtotime($booking['updated_at']));

            // Calculate timeline status
            $timeline = [
                'booked' => true,
                'confirmed' => !in_array($booking['status'], ['pending']),
                'service' => in_array($booking['status'], ['in_progress', 'completed']),
                'completed' => $booking['status'] === 'completed'
            ];
            $booking['timeline'] = $timeline;

        }
    }
} catch (PDOException $e) {
    error_log("Error fetching client bookings: " . $e->getMessage());
    $_SESSION["error_message"] = $e->getMessage();
    $recent_bookings = [];
    $status_counts = [
        'all' => 0,
        'pending' => 0,
        'accepted' => 0,
        'in_progress' => 0,
        'completed' => 0,
        'cancelled' => 0
    ];
}
?>