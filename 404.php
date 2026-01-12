<?php
// 404.php
require_once __DIR__ . "/Config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Fixo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-gray-50 to-white min-h-screen flex flex-col items-center justify-center p-4">
    
    <!-- Main Content -->
    <div class="max-w-4xl mx-auto text-center">
        
        <!-- Error Code -->
        <div class="relative mb-8">
            <div class="text-[180px] sm:text-[220px] md:text-[280px] font-bold text-gray-200 leading-none">
                404
            </div>
            
            <!-- Animated Icon -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="relative">
                    <div class="w-32 h-32 sm:w-40 sm:h-40 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center float-animation">
                        <i class="fas fa-wrench text-white text-5xl sm:text-6xl"></i>
                    </div>
                    
                    <!-- Floating Tools -->
                    <div class="absolute -top-4 -left-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center rotate-12">
                            <i class="fas fa-screwdriver text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center -rotate-12">
                            <i class="fas fa-hammer text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -left-6">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center rotate-45">
                            <i class="fas fa-bolt text-yellow-600 text-lg"></i>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-6">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center -rotate-45">
                            <i class="fas fa-cogs text-red-600 text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Message -->
        <div class="mb-10">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Oops! Page Not Found
            </h1>
            <p class="text-gray-600 text-lg sm:text-xl max-w-2xl mx-auto mb-6">
                It looks like the page you're trying to reach is under repair or doesn't exist.
                Let's get you back on track!
            </p>
            
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <a href="<?php echo BASE_URL; ?>"
               class="px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl hover:from-orange-600 hover:to-orange-700 font-medium text-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center group">
                <i class="fas fa-home mr-3"></i>
                Go to Homepage
                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
            
            <a href="javascript:history.back()"
               class="px-8 py-4 bg-white text-gray-800 border-2 border-gray-200 rounded-xl hover:border-orange-500 hover:bg-orange-50 font-medium text-lg shadow-sm hover:shadow transition-all duration-300 flex items-center justify-center group">
                <i class="fas fa-arrow-left mr-3"></i>
                Go Back
            </a>
            
            <a href="<?php echo BASE_URL; ?>dashboard.php"
               class="px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 font-medium text-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center group">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
        </div>
        
        <!-- Quick Links -->
        <div class="mb-12">
            <h3 class="text-lg font-medium text-gray-700 mb-6">Popular Pages</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="<?php echo BASE_URL; ?>dashboard.php"
                   class="p-4 bg-white border border-gray-200 rounded-xl hover:border-orange-500 hover:shadow transition-all duration-300 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-orange-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-plus text-orange-600"></i>
                    </div>
                    <span class="font-medium text-gray-800">New Booking</span>
                </a>
                
                <a href="<?php echo BASE_URL; ?>trackBooking.php"
                   class="p-4 bg-white border border-gray-200 rounded-xl hover:border-blue-500 hover:shadow transition-all duration-300 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-check text-blue-600"></i>
                    </div>
                    <span class="font-medium text-gray-800">Track Booking</span>
                </a>
                
                <a href="<?php echo BASE_URL; ?>login.php"
                   class="p-4 bg-white border border-gray-200 rounded-xl hover:border-green-500 hover:shadow transition-all duration-300 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-sign-in-alt text-green-600"></i>
                    </div>
                    <span class="font-medium text-gray-800">Login</span>
                </a>
                
                <a href="<?php echo BASE_URL; ?>register.php"
                   class="p-4 bg-white border border-gray-200 rounded-xl hover:border-purple-500 hover:shadow transition-all duration-300 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-purple-600"></i>
                    </div>
                    <span class="font-medium text-gray-800">Register</span>
                </a>
            </div>
        </div>
        
    
        
    </div>
    
    <!-- Footer -->
    <div class="mt-12 pt-8 border-t border-gray-200 text-center">
        <div class="flex items-center justify-center mb-4">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center mr-3">
                <span class="text-white font-bold text-xl">F</span>
            </div>
            <span class="text-2xl font-bold text-gray-900">Fixo</span>
        </div>
        <p class="text-gray-500 text-sm">
            © <?php echo date('Y'); ?> Fixo Service Platform. All rights reserved.
        </p>
    </div>

</body>
</html>