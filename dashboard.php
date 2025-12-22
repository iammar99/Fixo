<?php
$pageTitle = "Home"; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    header(header: "Location:/login.php");
}


if (isset($_SESSION["success_message"]) && $_SESSION["success_message"] == true) {
    $success_message = $_SESSION["success_message"];
}

require_once "./includes/components/header.php";


if($_SESSION["user_type"] == "clients"){
    require_once "./includes/components/client-dashboard.php";
}
else{
    require_once "./includes/components/provider-dashboard.php";
}

?>

<!-- Success Message Box - from first file -->
<?php if (!empty($success_message)): ?>
    <div id="successBox"
        class="fixed top-6 right-6 w-72 bg-green-500 text-white p-4 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-500 z-50">
        <div class="flex items-center">
            <span>✅</span>
            <span class="ml-2"><?php echo htmlspecialchars($success_message); ?></span>
        </div>
    </div>
<?php endif; ?>





<script>

    const successBox = document.getElementById('successBox');
    if (successBox) {
        setTimeout(() => {
            successBox.classList.remove('translate-x-full', 'opacity-0');
            successBox.classList.add('translate-x-0', 'opacity-100');
        }, 100);

        setTimeout(() => {
            successBox.classList.add('translate-x-full', 'opacity-0');
            successBox.classList.remove('translate-x-0', 'opacity-100');
        }, 4000);
    }

</script>

<?php
require_once "./includes/components/footer.php";
unset($success_message);
unset($_SESSION["success_message"]);

?>