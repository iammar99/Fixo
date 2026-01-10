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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f9fafb;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
        }
        .email-header {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 32px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .email-body {
            padding: 40px 30px;
            text-align: center;
        }
        .greeting {
            color: #111827;
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .otp-container {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 12px;
            padding: 25px;
            margin: 30px auto;
            max-width: 320px;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }
        .otp-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }
        .otp-code {
            color: #ffffff;
            font-size: 40px;
            font-weight: 800;
            letter-spacing: 8px;
            margin: 15px 0;
            font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Fira Code', monospace;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .expiry-note {
            color: #dc2626;
            font-size: 14px;
            margin-top: 20px;
            padding: 14px;
            background: #fef2f2;
            border-radius: 8px;
            border: 1px solid #fecaca;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .expiry-note strong {
            font-weight: 600;
        }
        .footer {
            background: #f9fafb;
            padding: 25px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            border-top: 1px solid #e5e7eb;
        }
        .security-note {
            background: #eff6ff;
            border: 1px solid #dbeafe;
            padding: 20px;
            margin: 30px 0;
            border-radius: 8px;
            text-align: left;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .security-note p {
            margin: 8px 0;
            color: #1e40af;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .security-note p strong {
            color: #1e3a8a;
            font-weight: 600;
            min-width: 100px;
        }
        .icon {
            color: #f97316;
            font-size: 16px;
            min-width: 20px;
        }
        .company-name {
            color: #f97316;
            font-weight: bold;
            font-size: 18px;
        }
        .support-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }
        .support-link:hover {
            text-decoration: underline;
        }
        .logo {
            display: inline-block;
            font-size: 24px;
            font-weight: bold;
            color: white;
            margin-bottom: 15px;
        }
        .button {
            display: inline-block;
            background: #f97316;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
            transition: background-color 0.2s;
        }
        .button:hover {
            background: #ea580c;
        }
        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class='email-container'>
        <div class='email-header'>
            <div class='logo'>FIXO</div>
            <h1>🔐 Account Verification</h1>
        </div>
        
        <div class='email-body'>
            <p class='greeting'>Hello $name !</p>
            <p class='message'>
                We received a request to verify your Fixo account. Use the One-Time Password (OTP) below to complete your verification process.
            </p>
            
            <div class='otp-container'>
                <div class='otp-label'>Your Verification Code</div>
                <div class='otp-code'>$OTP</div>
            </div>
            
            
            <div class='security-note'>
                <p><strong>🛡️ Security Notice:</strong></p>
                <p>
                    <span class='icon'>•</span> Never share this code with anyone, including Fixo support
                </p>
                <p>
                    <span class='icon'>•</span> We will never ask for your password or OTP via phone or email
                </p>
                <p>
                    <span class='icon'>•</span> If you didn't request this, please secure your account immediately
                </p>
            </div>            
  
        </div>
        
        <div class='footer'>
            <p>© <?php echo date('Y'); ?> <span class='company-name'>Fixo</span>. All rights reserved.</p>
            <p style='margin-top: 10px; font-size: 13px;'>
                This email was sent to you because you registered on Fixo Service Platform.<br>
            </p>
            <p style='margin-top: 15px; font-size: 12px; color: #9ca3af;'>
                Fixo Inc., Service Platform<br>
            </p>
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