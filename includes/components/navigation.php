<?php
if (session_status() === PHP_SESSION_NONE) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
require_once __DIR__ . '/../../Config/config.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixo - Mobile Mechanics On-Demand</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'fixo-orange': '#f97316',
                        'fixo-dark': '#1f2937',
                        'fixo-blue': '#3b82f6',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'blob': 'blob 7s infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(20px, -30px) scale(1.05)' },
                            '66%': { transform: 'translate(-15px, 15px) scale(0.95)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-white text-gray-900">
    <!-- Navigation -->
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/">
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-fixo-orange to-orange-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900">Fixo</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-fixo-orange font-medium transition-colors">Home</a>
                    <a href="dashboard.php"
                        class="text-gray-700 hover:text-fixo-orange font-medium transition-colors">Dashboard</a>
                    <a href="#howItWorks" class="text-gray-700 hover:text-fixo-orange font-medium transition-colors">How
                        It
                        Works</a>
                    <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1): ?>
                        <a href="/admin.php"
                            class="text-gray-700 hover:text-fixo-orange font-medium transition-colors">Admin</a>
                    <?php endif ?>
                    <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "clients"): ?>
                        <a href="/trackBooking.php"
                            class="text-gray-700 hover:text-fixo-orange font-medium transition-colors">Track Your Order</a>
                    <?php endif ?>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <?php if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]): ?>
                        <a href="/login.php"
                            class="px-4 py-2 text-gray-700 font-medium hover:text-fixo-orange transition-colors">Login</a>
                        <a href="/registeration.php"
                            class="px-4 py-2 bg-fixo-orange text-white font-medium rounded-lg hover:bg-orange-600 transition-colors">Register</a>
                    <?php else: ?>
                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button id="profile-dropdown-btn" class="flex items-center space-x-2 focus:outline-none">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-fixo-orange to-orange-500 rounded-full flex items-center justify-center text-white font-semibold hover:shadow-lg transition-shadow cursor-pointer">
                                    <?php
                                    $displayName = isset($_SESSION["user"]['name']) ? $_SESSION["user"]['name'] : (isset($_SESSION["user"]['email']) ? $_SESSION["user"]['email'] : 'U');
                                    echo strtoupper(substr($displayName, 0, 1));
                                    ?>
                                </div>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="profile-dropdown-menu"
                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border border-gray-200 z-50">
                                <a href="/profile.php"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        <span>Profile</span>
                                    </div>
                                </a>
                                <hr class="my-2 border-gray-200">
                                <a href="<?php echo BASE_URL; ?>Proccessing_pages/Logout/logout_proccessing.php"
                                    class="block px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        <span>Logout</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-md text-gray-700">
                    <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu (Hidden by default) -->
            <div id="mobile-menu" class="md:hidden hidden py-4 border-t border-gray-200 mt-2">
                <div class="space-y-4">
                    <a href="/"
                        class="block text-gray-700 hover:text-fixo-orange font-medium transition-colors">Home</a>
                    <a href="dashboard.php"
                        class="block text-gray-700 hover:text-fixo-orange font-medium transition-colors">Dashboard</a>
                    <a href="#howItWorks"
                        class="block text-gray-700 hover:text-fixo-orange font-medium transition-colors">How It
                        Works</a>

                    <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1): ?>
                        <a href="/admin.php"
                            class="block text-gray-700 hover:text-fixo-orange font-medium transition-colors">Admin</a>
                    <?php endif ?>
                    <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "clients"): ?>
                        <a href="/trackBooking.php"
                            class="block text-gray-700 hover:text-fixo-orange font-medium transition-colors ">Track Your Order</a>
                    <?php endif ?>

                    <hr class="border-gray-200">

                    <?php if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]): ?>
                        <a href="/login.php"
                            class="block px-4 py-2 text-gray-700 font-medium hover:text-fixo-orange transition-colors">Login</a>
                        <a href="/registeration.php"
                            class="block px-4 py-2 bg-fixo-orange text-white font-medium rounded-lg hover:bg-orange-600 transition-colors text-center">Register</a>
                    <?php else: ?>
                        <a href="/profile.php"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded transition-colors">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                                <span>Profile</span>
                            </div>
                        </a>
                        <a href="<?php echo BASE_URL; ?>Proccessing_pages/Logout/logout_proccessing.php"
                            class="block px-4 py-2 text-red-600 hover:bg-red-50 rounded transition-colors">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                <span>Logout</span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>


</body>

</html>


<!-- Add this JavaScript at the end of your file (before closing </body>) -->
<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function () {
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', function () {
                // Toggle menu visibility
                mobileMenu.classList.toggle('hidden');

                // Toggle icons
                if (menuIcon && closeIcon) {
                    menuIcon.classList.toggle('hidden');
                    closeIcon.classList.toggle('hidden');
                }
            });

            // Close menu when clicking outside
            document.addEventListener('click', function (event) {
                if (!menuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                    if (menuIcon && closeIcon) {
                        menuIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    }
                }
            });

            // Close menu when clicking a link
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function () {
                    mobileMenu.classList.add('hidden');
                    if (menuIcon && closeIcon) {
                        menuIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    }
                });
            });
        }

        // Profile Dropdown Toggle
        const profileBtn = document.getElementById('profile-dropdown-btn');
        const profileMenu = document.getElementById('profile-dropdown-menu');

        if (profileBtn && profileMenu) {
            profileBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                profileMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
                    profileMenu.classList.add('hidden');
                }
            });
        }
    });
</script>