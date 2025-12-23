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
    $errors = [];
    
    $name = trim($_POST["name"] ?? '');
    $phone = trim($_POST["phone"] ?? '');
    $address = trim($_POST["address"] ?? '');

    var_dump($_POST);
    
    // Validation
    if (empty($name)) {
        $errors[] = "Full name is required";
    } elseif (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters";
    } elseif (strlen($name) > 50) {
        $errors[] = "Name cannot exceed 50 characters";
    }
    
    if (!empty($phone)) {
        // Clean phone number
        $phone = preg_replace('/[^0-9\+]/', '', $phone);
        
        if (strlen($phone) < 10 || strlen($phone) > 15) {
            $errors[] = "Phone number should be between 10 and 15 digits";
        }
    } else {
        $errors[] = "Phone number is required";
    }
    
    if (empty($address)) {
        $errors[] = "Address is required";
    } elseif (strlen($address) < 10) {
        $errors[] = "Please enter a complete address";
    }
    
    if (empty($errors)) {
        try {
            $database = new Database();
            $db = $database->getConnection();
            
            $query = "UPDATE clients 
                     SET name = :name,
                         phone = :phone, 
                         address = :address
                     WHERE email = :email";
            
            $stmt = $db->prepare($query);
            
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":address", $address, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $rowCount = $stmt->rowCount();
                
                if ($rowCount > 0) {
                    // Update session data
                    $_SESSION["user"]["name"] = $name;
                    $_SESSION["user"]["phone"] = $phone;
                    $_SESSION["user"]["address"] = $address;
                    
                    $_SESSION["success_message"] = "Profile updated successfully!";
                } else {
                    $_SESSION["error_message"] = "No changes made or user not found.";
                }
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("SQL Error: " . print_r($errorInfo, true));
                $_SESSION["error_message"] = "Database error. Please try again.";
            }
            
        } catch (PDOException $e) {
            error_log("PDO Exception: " . $e->getMessage());
            $_SESSION["error_message"] = "Database connection error: " . $e->getMessage();
        } catch (Exception $e) {
            error_log("General Exception: " . $e->getMessage());
            $_SESSION["error_message"] = "An unexpected error occurred.";
        }
    } else {
        $_SESSION["error_message"] = implode("<br>", $errors);
        $_SESSION["old_form_data"] = [
            'name' => $_POST["name"] ?? '',
            'phone' => $_POST["phone"] ?? '',
            'address' => $_POST["address"] ?? ''
        ];
    }
    
    header("Location: /profile.php");
    var_dump($_SESSION["error_message"]);
    exit();
} else {
    header("Location: /profile.php");
    exit();
}
?>