<?php
require_once __DIR__ . "/../../includes/db/database.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


try {
    $database = new Database();
    $db = $database->getConnection();

    $mechanics = [];

    if ($db) {
        $provider = $_SESSION["user"]["id"];

        $query = "SELECT b.*, c.name as customer 
              FROM bookings b 
              LEFT JOIN clients c ON b.client_id = c.id 
              WHERE b.provider_id = :provider";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":provider", $provider);
        $stmt->execute();
        $recent_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
} catch (PDOException $e) {
    echo "" . $e->getMessage() . "";
}

?>