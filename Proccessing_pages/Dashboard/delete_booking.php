<?php
session_start();
require_once "../../Config/config.php";
require_once "../../includes/db/database.php";



if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: " . BASE_URL . "bookings.php");
    exit(); 
}

$booking_id = $_POST["booking_id"];

try{
    $database = new Database();
    $db = $database->getConnection();
    if($db){
        $query = "DELETE FROM bookings WHERE id = :booking_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":booking_id", $booking_id);
        $stmt->execute();
        header("Location:" .BASE_URL . "dashboard.php");
        exit();
    }
} catch (Exception $e) {
    $_SESSION["error_message"] = "Some Error Occured";
    header("Location:" .BASE_URL . "dashboard.php");
    exit();
}
