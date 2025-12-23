<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../../includes/db/database.php";
require_once "../../Config/config.php";
require "../../Config/php_mail.php";
$mail = getMailer();


if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $service = $_POST["service_specialist"];

    $errors = [];

    if ($name == "") {
        $errors[] = "Name is required";
    }
    if ($email == "") {
        $errors[] = "Email is required";
    }
    if ($password == "") {
        $errors[] = "Password is required";
    }
    if ($confirm_password == "") {
        $errors[] = "Confirm Password is required";
    }
    if ($phone == "") {
        $errors[] = "Phone is required";
    }
    if ($address == "") {
        $errors[] = "Address is required";
    }
    if ($service == "") {
        $errors[] = "Service is required";
    }

    if ($password != $confirm_password) {
        $errors[] = "Password doesn't matched";
    }


    if (empty($errors)) {
        try {
            $database = new Database();
            $db = $database->getConnection();
            if ($db) {
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
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                if ($user) {
                    $errors[] = "User with this Email already Exist";
                } else {
                    // Recipient
                    $mail->addAddress($email, 'Recipient');
                    $_SESSION["form_data"] = [
                        "name" => $name,
                        "email" => $email,
                        "phone" => $phone,
                        "address" => $address,
                        "hashed_password" => $hashedPassword,
                        "service" => $service,
                    ];
                    // OTP 
                    $OTP = rand(100000, 999999);
                    $_SESSION["otp"] = $OTP;
                    $_SESSION["user_type"] = "provider";
                    // Email Content
                    $mail->isHTML(true);
                    $mail->Subject = 'OTP From Fixo';
                    $mail->Body = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .email-header {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .email-body {
            background: #ffffff;
            padding: 40px 30px;
            text-align: center;
        }
        .greeting {
            color: #333333;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .message {
            color: #666666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .otp-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 25px;
            margin: 30px auto;
            max-width: 300px;
        }
        .otp-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .otp-code {
            color: #ffffff;
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 8px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
        }
        .expiry-note {
            color: #ff6b6b;
            font-size: 14px;
            margin-top: 20px;
            padding: 12px;
            background: #fff5f5;
            border-radius: 8px;
            border-left: 4px solid #ff6b6b;
        }
        .footer {
            background: #f8f9fa;
            padding: 25px;
            text-align: center;
            color: #888888;
            font-size: 13px;
            border-top: 1px solid #e9ecef;
        }
        .security-note {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            text-align: left;
        }
        .security-note p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class='email-container'>
        <div class='email-header'>
            <h1>🔐 Verification Code</h1>
        </div>
        
        <div class='email-body'>
            <p class='greeting'><strong>Hello!</strong></p>
            <p class='message'>
                We received a request to verify your account. Please use the One-Time Password (OTP) below to complete your verification.
            </p>
            
            <div class='otp-container'>
                <div class='otp-label'>Your OTP Code</div>
                <div class='otp-code'>$OTP</div>
            </div>
            
            // <div class='expiry-note'>
            //     ⏰ This code will expire in <strong>10 minutes</strong>
            // </div>
            
            <div class='security-note'>
                <p><strong>🛡️ Security Tips:</strong></p>
                <p>• Never share this code with anyone</p>
                <p>• We will never ask for your OTP via phone or email</p>
                <p>• If you didn't request this code, please ignore this email</p>
            </div>
        </div>
        
        <div class='footer'>
            <p>If you have any questions, feel free to contact our support team.</p>
            <p style='margin-top: 15px;'>© 2024 Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
";
                    $mail->AltBody = "Hello! This is a your $OTP";

                    $mail->send();
                    header("Location: " . BASE_URL . "otp.php");
                    echo "Email sent successfully!";
                }
            } else {
                $errors[] = "Error in collecting database";
            }
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        $_SESSION["form_data"] = $_POST;
        $_SESSION["form_type"] = "provider";
        // var_dump($_SESSION["errors"]);
        header("Location: " . BASE_URL . "registeration.php");
    }

    // var_dump($_POST);
}

?>