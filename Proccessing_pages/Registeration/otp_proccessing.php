<?php

session_start();
require_once "../../Config/config.php";

var_dump($_SERVER['REQUEST_METHOD']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $otp1 = $_POST["otp1"];
    $otp2 = $_POST["otp2"];
    $otp3 = $_POST["otp3"];
    $otp4 = $_POST["otp4"];
    $otp5 = $_POST["otp5"];
    $otp6 = $_POST["otp6"];


    $recieved = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;

    if ($recieved == $_SESSION["otp"]) {
        $formData = $_SESSION["form_data"];
        $name = $formData["name"];
        $email = $formData["email"];
        $phone = $formData["phone"];
        $address = $formData["address"];
        $password = $formData["hashed_password"];
        $service = $formData["service"];
        if ($_SESSION["user_type"] == "clients") {
            try {
                require_once "../../includes/db/database.php";
                $database = new Database();
                $db = $database->getConnection();

                if ($db) {
                    // Insert query for registration
                    $query = "
    INSERT INTO clients
    (name, email, phone, password, address)
    VALUES
    (:name, :email, :phone, :password, :address)
";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->bindParam(":password", $password);
                    $stmt->bindParam(":address", $address);

                    // Execute the query
                    if ($stmt->execute()) {
                        // Success: Redirect to success page
                        $_SESSION["success_message"] = "Registered Successfully";
                        $_SESSION["logged_in"] = true;
                        $_SESSION["is_admin"] = 0;
                        $user = [
                            'id' => $lastId,
                            'name' => $name,
                            'email' => $email,
                            'phone' => $phone,
                            'address' => $address,
                            'isAdmin' => 0,
                            'status' => 0,
                            'createdat' => date('Y-m-d H:i:s')
                        ];
                        $_SESSION["user"] = $user;
                        $_SESSION["user_type"] = "clients";
                        unset($_SESSION['form_data']);
                        unset($_SESSION['otp']);
                        unset($_SESSION['errors']);
                        header("Location: " . BASE_URL . "dashboard.php");
                        exit();
                    } else {
                        // Error while inserting data
                        $_SESSION["errors"] = ["Error in registering. Please try again."];
                        header("Location: " . BASE_URL . "registeration.php");
                        exit();
                    }
                } else {
                    $_SESSION["errors"] = ["Error in connecting to the database"];
                    header("Location: " . BASE_URL . "registeration.php");
                    exit();
                }
            } catch (Exception $e) {
                // Handle any errors
                $_SESSION["errors"] = ["Database error: " . $e->getMessage()];
                header("Location: " . BASE_URL . "registeration.php");
                exit();
            }
        } else {
            try {
                require_once "../../includes/db/database.php";
                $database = new Database();
                $db = $database->getConnection();
                if ($db) {
                    $query = "
    INSERT INTO providers
    (name, email, phone, password, address, service)
    VALUES
    (:name, :email, :phone, :password, :address, :service)
";

                    $stmt = $db->prepare($query);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->bindParam(":password", $password);
                    $stmt->bindParam(":address", $address);
                    $stmt->bindParam(":service", $service);
                    if ($stmt->execute()) {
                        $user = [
                            'id' => $lastId,
                            'name' => $name,
                            'email' => $email,
                            'phone' => $phone,
                            'address' => $address,
                            'service' => $service,
                            'rating' => 0.0,
                            'availability' => 'available',
                            'isAdmin' => 0,
                            'status' => 0,
                            'createdat' => date('Y-m-d H:i:s')
                        ];
                        $_SESSION["success_message"] = "Registered Successfully";
                        unset($_SESSION['form_data']);
                        unset($_SESSION['otp']);
                        unset($_SESSION['errors']);
                        $_SESSION["logged_in"] = true;
                        $_SESSION["is_admin"] = 0;
                        $_SESSION["user"] = $user;
                        $_SESSION["user_type"] = "providers";
                        header("Location: " . BASE_URL . "dashboard.php");
                        exit();
                    } else {
                        $errors[] = "Error in Registering. Please try again";
                    }
                } else {
                    $_SESSION["errors"] = ["Error in connecting to the database"];
                    header("Location: " . BASE_URL . "registeration.php");
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION["errors"] = ["Database error: " . $e->getMessage()];
                header("Location: " . BASE_URL . "registeration.php");
                exit();
            }
        }
    } else {
        $_SESSION["errors"] = ["Wrong OTP Try again"];
        header("Location: " . BASE_URL . "otp.php");
        exit();
    }
}
?>