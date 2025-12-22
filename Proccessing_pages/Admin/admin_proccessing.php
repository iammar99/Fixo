<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "includes/db/database.php";
require_once "Config/config.php";

$database = new Database();
$db = $database->getConnection();

$clients = [];
$providers = [];

if ($db) {
    // =============| Clients with status |=============
    $query = "SELECT id, name, email, phone, address, status, createdat as createdat FROM clients";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // =============| Providers with status |=============
    $query = "SELECT id, name, email, phone, address, service, status, createdat as createdat FROM providers";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $providers = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>