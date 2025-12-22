<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["logged_in"] = false;
unset($_SESSION["is_admin"]);
unset($_SESSION["user"]);
require_once "../../Config/config.php";

header("Location: " . BASE_URL);
?>