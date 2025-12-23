<?php
$pageTitle = "Home";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    header(header: "Location:/login.php");
}


if (isset($_SESSION["success_message"])) {
    $success_message = $_SESSION["success_message"];
}

if (isset($_SESSION["error_message"])) {
    $error_message = $_SESSION["error_message"];
}

require_once "./includes/components/header.php";


if ($_SESSION["user_type"] == "clients") {
    require_once "./includes/components/client-dashboard.php";
} else {
    require_once "./includes/components/provider-dashboard.php";
}

?>
<!-- Message Boxes Container -->
<div class="fixed top-6 right-6 z-50 space-y-3">
    <!-- Success Message Box -->
    <?php if (!empty($success_message)): ?>
        <div id="successBox"
            class="w-72 bg-green-500 text-white p-4 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span>✅</span>
                    <span class="ml-2"><?php echo htmlspecialchars($success_message); ?></span>
                </div>
                <button onclick="closeMessage('successBox')" class="text-white hover:text-gray-200 ml-2">
                    &times;
                </button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Error Message Box -->
    <?php if (!empty($error_message)): ?>
        <div id="errorBox"
            class="w-72 bg-red-500 text-white p-4 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span>❌</span>
                    <span class="ml-2">
                        <?php
                        if (is_array($error_message)) {
                            echo htmlspecialchars(implode("<br>", $error_message));
                        } else {
                            echo htmlspecialchars($error_message);
                        }
                        ?>
                    </span>
                </div>
                <button onclick="closeMessage('errorBox')" class="text-white hover:text-gray-200 ml-2">
                    &times;
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>



<script>
    <!-- Message Boxes Container -->
    <div class="fixed top-6 right-6 z-50 space-y-3">
        <!-- Success Message Box -->
        <?php if (!empty($success_message)): ?>
            <div id="successBox"
                class="w-72 bg-green-500 text-white p-4 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span>✅</span>
                        <span class="ml-2"><?php echo htmlspecialchars($success_message); ?></span>
                    </div>
                    <button onclick="closeMessage('successBox')" class="text-white hover:text-gray-200 ml-2">
                        &times;
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <!-- Error Message Box -->
        <?php if (!empty($error_message)): ?>
            <div id="errorBox"
                class="w-72 bg-red-500 text-white p-4 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span>❌</span>
                        <span class="ml-2">
                            <?php
                            if (is_array($error_message)) {
                                echo htmlspecialchars(implode("<br>", $error_message));
                            } else {
                                echo htmlspecialchars($error_message);
                            }
                            ?>
                        </span>
                    </div>
                    <button onclick="closeMessage('errorBox')" class="text-white hover:text-gray-200 ml-2">
                        &times;
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>

</script>

<?php
require_once "./includes/components/footer.php";
unset($success_message);
if (isset($_SESSION["success_message"])) {
    unset($_SESSION["success_message"]);
}
if (isset($_SESSION["error_message"])) {
    unset($_SESSION["error_message"]);
}
?>