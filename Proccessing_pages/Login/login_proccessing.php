<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../../includes/db/database.php";
require_once "../../Config/config.php";

// var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $email = $_POST["email"];
    $password = $_POST["password"];

    $errors = [];


    if ($email == "") {
        $errors[] = "Email is required";
    }
    if ($password == "") {
        $errors[] = "Password is required";
    }


    if (empty($errors)) {
        try {
            $database = new Database();
            $db = $database->getConnection();

            if (!$db) {
                $errors[] = "Database connection failed";
            } else {

                // =========| Search user in both tables |=========
                $tables = ["clients", "providers"];
                $user = null;
                $user_type = null;

                foreach ($tables as $table) {
                    $sql = "SELECT * FROM $table WHERE email = :email LIMIT 1";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(":email", $email);
                    $stmt->execute();

                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($result) {
                        $user = $result;
                        $user_type = $table;
                        break;
                    }
                }

                // =========| If no user found |=========
                if (!$user) {
                    $errors[] = "User doesn't exist";
                } else {
                    // =========| Check if user is restricted |=========

                    if ($user["status"]) {
                        $errors[] = "Your Account is restricted";
                    } else {


                        // =========| Password check |=========
                        if (!password_verify($password, $user["password"])) {
                            $errors[] = "Password doesn't match";
                        } else {




                            // =========| Success |=========
                            $_SESSION["success_message"] = ucfirst(rtrim($user_type, 's')) . " Login Successful";
                            $_SESSION["errors"] = [];
                            $_SESSION["logged_in"] = true;
                            $_SESSION["is_admin"] = $user["isAdmin"];
                            $_SESSION["user"] = $user;
                            $_SESSION["user_type"] = $user_type;
                            if($user_type == "clients"){
                                header("Location: " . BASE_URL . "dashboard.php");
                            }else{
                                header("Location: " . BASE_URL . "dashboard.php");
                            }
                            exit();
                        }
                    }
                }
            }

        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }

    }

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        $_SESSION["form_data"] = $_POST;
        $_SESSION["form_type"] = "client";
        // var_dump($_SESSION["errors"]);
        header("Location: " . BASE_URL . "login.php");
    }

    // var_dump($_POST);
}

?>