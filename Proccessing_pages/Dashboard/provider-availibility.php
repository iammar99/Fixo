<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("../../includes/db/database.php");

if (!isset($_SESSION["user"]) || !isset($_SESSION["user"]["email"])) {
    header("Location: /login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION["user"]["email"];
    
    $isAvailable = isset($_POST["availability"]) && $_POST["availability"] === "on";
    $availabilityValue = $isAvailable ? "available" : "offline";
    
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $query = "UPDATE providers SET availability = :availability WHERE email = :email";
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(":availability", $availabilityValue);
        $stmt->bindParam(":email", $email);
        
        if ($stmt->execute()) {
            if (isset($_SESSION["user"]["availability"])) {
                $_SESSION["user"]["availability"] = $availabilityValue;
            }
            
            $_SESSION['success_message'] = "Availability updated successfully!";
        } else {
            $_SESSION['error_message'] = "Failed to update availability.";
        }
        
    } catch (Exception $e) {
        error_log("Availability update error: " . $e->getMessage());
        $_SESSION['error_message'] = "An error occurred while updating availability.";
    }
    header("Location: /dashboard.php");
    exit();
}

header("Location: /dashboard.php");
exit();
?>