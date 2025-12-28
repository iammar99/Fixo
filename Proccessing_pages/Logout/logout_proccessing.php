<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../../includes/db/database.php";
if ($_SESSION["user_type"] == "providers") {
    var_dump($_SESSION["user_type"]);
    var_dump($_SESSION["user"]["email"]);
    $email = $_SESSION["user"]["email"];
    $availability = "offline";

    $database = new Database();
    $db = $database->getConnection();

    if ($db) {
        $query = "UPDATE providers SET availability = :availability WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":availability", $availability);
        $stmt->bindParam(":email", $email);
        if ($stmt->execute()) {
            $_SESSION["logged_in"] = false;
            unset($_SESSION["is_admin"]);
            unset($_SESSION["user"]);
            require_once "../../Config/config.php";
            header("Location: " . BASE_URL);
        } else {
            $_SESSION["error_message"] = "Logout Failed";
        }
    } else {
        $_SESSION["error_message"] = "Database Connection Failed";
    }


} else {
    $_SESSION["logged_in"] = false;
    unset($_SESSION["is_admin"]);
    unset($_SESSION["user"]);
    require_once "../../Config/config.php";

    header("Location: " . BASE_URL);
}
?>