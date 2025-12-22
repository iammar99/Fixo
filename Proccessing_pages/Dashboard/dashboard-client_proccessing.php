<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "includes/db/database.php";
require_once "Config/config.php";

$database = new Database();
$db = $database->getConnection();

$mechanics = [];

if ($db) {
    // =============| Providers with status |=============
    $query = "SELECT id, name, email, phone, address, service, status,availability,rating,rating, createdat as createdat FROM providers";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $mechanics = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>