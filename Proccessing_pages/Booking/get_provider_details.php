<?php
// provider-details-proccessing.php
require_once __DIR__ . "/../../includes/db/database.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

$provider = [];
$provider_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($provider_id) {
    try {
        $database = new Database();
        $db = $database->getConnection();

        if ($db) {
            // Fetch provider details
            $query = "SELECT * FROM providers WHERE id = :provider_id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":provider_id", $provider_id);
            $stmt->execute();
            $provider = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        error_log("Error fetching provider details: " . $e->getMessage());
    }
}
?>