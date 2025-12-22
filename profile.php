<?php
$pageTitle = "Profile";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    header("Location: login.php");
    exit();
}

// Get user data from session
$user_type = $_SESSION["user_type"] ?? "";
$user_data = $_SESSION["user"] ?? [];
$user_id = $user_data['id'] ?? 0;

// Get messages from session
$success_message = $_SESSION["success_message"] ?? null;
$error_message = $_SESSION["error_message"] ?? null; // This could be an array!
$old_form_data = $_SESSION["old_form_data"] ?? null;

require_once "./includes/db/database.php";
require_once "./includes/components/header.php";
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
                        // Handle both string and array error messages
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

<!-- Main Content -->
<div class="min-h-screen bg-gray-50">
    <?php
    if ($user_type == "clients") {
        require_once "./includes/components/client-profile.php";
    } elseif ($user_type == "providers") {
        require_once "./includes/components/provider-profile.php";
    } else {
        echo "<div class='max-w-7xl mx-auto px-4 py-8'>";
        echo "<div class='bg-white rounded-lg shadow p-6 text-center'>";
        echo "<h2 class='text-2xl font-bold text-gray-800 mb-4'>Profile Error</h2>";
        echo "<p class='text-gray-600'>User type '{$user_type}' not recognized.</p>";
        echo "</div></div>";
    }
    ?>
</div>

<script>
    // Function to show messages with animation
    function showMessage(boxId) {
        const box = document.getElementById(boxId);
        if (box) {
            setTimeout(() => {
                box.classList.remove('translate-x-full', 'opacity-0');
                box.classList.add('translate-x-0', 'opacity-100');
            }, 100);

            // Auto-hide after 5 seconds
            setTimeout(() => {
                closeMessage(boxId);
            }, 5000);
        }
    }

    // Function to close message
    function closeMessage(boxId) {
        const box = document.getElementById(boxId);
        if (box) {
            box.classList.add('translate-x-full', 'opacity-0');
            box.classList.remove('translate-x-0', 'opacity-100');
            
            // Remove from DOM after animation
            setTimeout(() => {
                if (box.parentNode) {
                    box.parentNode.removeChild(box);
                }
            }, 500);
        }
    }

    // Initialize message display
    document.addEventListener('DOMContentLoaded', function() {
        const successBox = document.getElementById('successBox');
        const errorBox = document.getElementById('errorBox');
        
        if (successBox) {
            showMessage('successBox');
        }
        
        if (errorBox) {
            showMessage('errorBox');
        }
        
        // Close message when clicking anywhere on the message
        const messageBoxes = document.querySelectorAll('#successBox, #errorBox');
        messageBoxes.forEach(box => {
            box.addEventListener('click', function(e) {
                if (e.target === this || e.target.closest('button')) {
                    closeMessage(this.id);
                }
            });
        });
    });
</script>

<?php
require_once "./includes/components/footer.php";

// Clear messages from session after displaying
if (isset($_SESSION["success_message"])) {
    unset($_SESSION["success_message"]);
}
if (isset($_SESSION["error_message"])) {
    unset($_SESSION["error_message"]);
}
if (isset($_SESSION["old_form_data"])) {
    unset($_SESSION["old_form_data"]);
}
?>