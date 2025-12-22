<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// require_once __DIR__ . '/../includes/db/database.php';
require_once "../../includes/db/database.php";
require_once "../../Config/config.php";

// require_once "Config/config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $type = $_POST["type"];
    $status = $_POST["status"];

    $new_status = ($status == 1) ? 0 : 1;


    $errors = [];

    try {
        $database = new Database();
        $db = $database->getConnection();

        if ($db) {
            $sql = "SELECT * FROM $type WHERE id = :id LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = "UPDATE $type SET status = $new_status WHERE id = :id;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: " . BASE_URL . "admin.php");
            exit();
        } else {
            $errors[] = "Error in connecting database";
        }
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
}

?>