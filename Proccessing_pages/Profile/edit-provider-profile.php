<?php
session_start();

require_once("../../includes/db/database.php");

if (!isset($_SESSION["user"]) || !isset($_SESSION["user"]["email"])) {
    header("Location: /login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION["user"]["email"];
    $errors = [];

    $name = trim($_POST["name"] ?? '');
    $phone = trim($_POST["phone"] ?? '');
    $service = trim($_POST["service"] ?? '');
    $address = trim($_POST["address"] ?? '');

    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters";
    }

    if (!empty($phone)) {
        $phone = preg_replace('/[^0-9\+]/', '', $phone);

        if (strlen($phone) < 10 || strlen($phone) > 15) {
            $errors[] = "Phone number should be between 10 and 15 digits";
        }
    } else {
        $errors[] = "Phone number is required";
    }

    if (empty($service)) {
        $errors[] = "Service specialization is required";
    }

    if (empty($address)) {
        $errors[] = "Address is required";
    }

    if (empty($errors)) {
        try {
            $database = new Database();
            $db = $database->getConnection();

            $checkQuery = "SELECT id FROM providers WHERE name = :name AND email != :email LIMIT 1";
            $checkStmt = $db->prepare($checkQuery);
            $checkStmt->bindParam(":name", $name, PDO::PARAM_STR);
            $checkStmt->bindParam(":email", $email, PDO::PARAM_STR);
            $checkStmt->execute();

            if ($checkStmt->fetch()) {
                $errors[] = "Name already taken. Please choose another.";
                $_SESSION["error_message"] = $errors;
                $_SESSION["old_form_data"] = [
                    'name' => $_POST["name"] ?? '',
                    'phone' => $_POST["phone"] ?? '',
                    'service' => $_POST["service"] ?? '',
                    'address' => $_POST["address"] ?? ''
                ];
                header("Location: /profile.php");
                exit();
            }

            $query = "UPDATE providers 
                     SET name = :name,
                         phone = :phone, 
                         service = :service, 
                         address = :address
                     WHERE email = :email";

            $stmt = $db->prepare($query);

            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":service", $service, PDO::PARAM_STR);
            $stmt->bindParam(":address", $address, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $rowCount = $stmt->rowCount();

                if ($rowCount > 0) {
                    $_SESSION["user"]["name"] = $name;
                    $_SESSION["user"]["phone"] = $phone;
                    $_SESSION["user"]["service"] = $service;
                    $_SESSION["user"]["address"] = $address;

                    $_SESSION["success_message"] = "Profile updated successfully!";
                    unset($_SESSION["error_message"]);
                } else {
                    $_SESSION["error_message"] = ["No changes made or user not found."];
                }
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("SQL Error: " . print_r($errorInfo, true));
                $_SESSION["error_message"] = ["Database error. Please try again."];
            }

        } catch (PDOException $e) {
            error_log("PDO Exception: " . $e->getMessage());
            $_SESSION["error_message"] = ["Database connection error."];
        } catch (Exception $e) {
            error_log("General Exception: " . $e->getMessage());
            $_SESSION["error_message"] = ["An unexpected error occurred."];
        }
    } else {
        $_SESSION["error_message"] = $errors;
        $_SESSION["old_form_data"] = [
            'name' => $_POST["name"] ?? '',
            'phone' => $_POST["phone"] ?? '',
            'service' => $_POST["service"] ?? '',
            'address' => $_POST["address"] ?? ''
        ];
    }

    header("Location: /profile.php");
    exit();
} else {
    $_SESSION["error_message"] = ["Invalid request method."];
    header("Location: /profile.php");
    exit();
}
?>