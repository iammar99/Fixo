<?php
$pageTitle = "Login";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
    header(header: "Location:/");
}


// Get all session data exactly like first file
$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
$success_message = $_SESSION['success_message'] ?? '';
// Add OTP and user_type if they exist (even if not used in form)
$otp = $_SESSION['otp'] ?? '';
$user_type = $_SESSION['user_type'] ?? '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fixo | Mobile Mechanic Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'fixo-orange': '#f97316',
                        'fixo-dark': '#1f2937',
                        'fixo-blue': '#3b82f6',
                    }
                }
            }
        }
    </script>
    <style>
        /* All your existing CSS remains exactly the same */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
        .min-h-screen {
            min-height: 100vh;
        }
        
        @media (max-width: 767px) {
            .min-h-screen {
                height: auto;
            }
            
            html, body {
                overflow-y: auto;
            }
            
            .md\\:w-1\\/2:first-child {
                display: none;
            }
            
            .md\\:w-1\\/2:last-child {
                width: 100% !important;
            }
            
            .transform.scale-95 {
                transform: none !important;
            }
            
            body::before {
                content: '';
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 60px;
                background: linear-gradient(to right, #f97316, #ea580c);
                z-index: 40;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <!-- Error Box - same as first file -->
    <?php if (!empty($errors)): ?>
        <div id="errorBox"
            class="fixed top-6 right-6 w-72 bg-red-500 text-white p-4 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-500 z-50">
            <ul class="list-none ml-4">
                <?php foreach ($errors as $error): ?>
                    <li class="flex items-center">⚠️ <?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>


    <!-- Mobile Header - unchanged -->
    <div class="md:hidden fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-fixo-orange to-orange-600 text-white p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mr-2">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold">Fixo</span>
            </div>
            <div class="text-sm font-medium">Login</div>
        </div>
    </div>

    <!-- Login Page Container - unchanged -->
    <div class="min-h-screen flex flex-col md:flex-row pt-[60px] md:pt-0">
        
        <!-- Left Side - Branding & Info (Hidden on mobile) - unchanged -->
        <div class="hidden md:block md:w-1/2 bg-gradient-to-br from-fixo-orange to-orange-600 text-white p-6 md:p-8">
            <div class="h-full flex flex-col justify-center max-w-sm mx-auto">
                <!-- Logo - unchanged -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-3xl font-bold">Fixo</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-6">Welcome Back</h1>
                    <p class="text-orange-100 text-lg">Access your account to book or provide mechanic services</p>
                </div>

                <!-- Benefits - unchanged -->
                <div class="space-y-6 mt-12">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Quick Access</h3>
                            <p class="text-orange-100">Get back to your bookings and services</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Secure Login</h3>
                            <p class="text-orange-100">Your account is protected with encryption</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Service Management</h3>
                            <p class="text-orange-100">Manage your services or bookings from anywhere</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form - unchanged except 3 lines -->
        <div class="w-full md:w-1/2 p-4 md:p-6 overflow-y-auto">
            <div class="max-w-md mx-auto md:transform md:scale-95 md:origin-top">
                
                <!-- Header - unchanged -->
                <div class="mb-8 md:mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Login to Fixo</h2>
                    <p class="text-gray-600">Access your account to continue</p>
                </div>

                <!-- User Type Selection - unchanged -->
                <!-- <div class="mb-8">
                    <div class="flex bg-gray-100 rounded-xl p-1">
                        <button type="button" id="customer-login-tab" class="flex-1 py-3 px-4 rounded-lg font-medium transition-all duration-300 bg-white shadow-sm text-gray-900">
                            Login as Customer
                        </button>
                    </div>
                </div> -->

                <!-- Login Form - ONLY 3 LINES CHANGED HERE -->
                <form action="Proccessing_pages/Login/login_proccessing.php" method="POST" class="space-y-6">
                    <!-- Hidden role field -->
                    <input type="hidden" name="role" id="role" value="customer">
                    
                    <!-- Email/Phone Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required 
                               value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-fixo-orange focus:ring-2 focus:ring-orange-100 focus:outline-none transition-all duration-300"
                               placeholder="Enter Email">
                    </div>

                    <!-- Password Input - unchanged -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" required id="password"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-fixo-orange focus:ring-2 focus:ring-orange-100 focus:outline-none transition-all duration-300 pr-12"
                                   placeholder="Enter your password">
                            <button type="button" onclick="togglePassword()" id="password-toggle" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password - unchanged -->
                    <div class="flex items-center justify-between">
                        <!-- <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-fixo-orange rounded border-gray-300 focus:ring-fixo-orange">
                            <label for="remember" class="ml-2 text-sm text-gray-700">Remember me</label>
                        </div> -->
                        <!-- <a href="#" class="text-sm text-fixo-orange hover:text-orange-600 font-medium">Forgot password?</a> -->
                    </div>

                    <!-- Submit Button - unchanged -->
                    <button type="submit" class="w-full py-3 bg-fixo-orange text-white font-bold rounded-xl hover:bg-orange-600 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                        Login to Account
                    </button>
                </form>

                <!-- Divider - unchanged -->
                <div class="my-8 flex items-center">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="px-4 text-gray-500 text-sm">Or continue with</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <!-- Social Login - unchanged -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <button type="button" class="flex items-center justify-center gap-2 py-3 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="text-sm font-medium">Google</span>
                    </button>
                    <button type="button" class="flex items-center justify-center gap-2 py-3 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="text-sm font-medium">Facebook</span>
                    </button>
                </div>

                <!-- Register Link - 1 LINE CHANGED HERE -->
                <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                    <p class="text-gray-600">
                        Don't have an account?
                        <a href="registeration.php" class="text-fixo-orange font-bold hover:text-orange-600 transition-colors ml-1">Register now</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Error box animation - unchanged
        const errorBox = document.getElementById('errorBox');
        if (errorBox) {
            setTimeout(() => {
                errorBox.classList.remove('translate-x-full', 'opacity-0');
                errorBox.classList.add('translate-x-0', 'opacity-100');
            }, 100);

            setTimeout(() => {
                errorBox.classList.add('translate-x-full', 'opacity-0');
                errorBox.classList.remove('translate-x-0', 'opacity-100');
            }, 4000);
        }

        // Success box animation - ADDED FROM FIRST FILE
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

        // Toggle between Customer and Mechanic login - unchanged
        document.addEventListener('DOMContentLoaded', function() {
            const customerTab = document.getElementById('customer-login-tab');
            const mechanicTab = document.getElementById('mechanic-login-tab');
            const roleField = document.getElementById('role');
            
            // Customer tab click
            customerTab.addEventListener('click', function() {
                // Update tabs
                customerTab.classList.add('bg-white', 'shadow-sm', 'text-gray-900');
                customerTab.classList.remove('text-gray-600');
                mechanicTab.classList.remove('bg-white', 'shadow-sm', 'text-gray-900');
                mechanicTab.classList.add('text-gray-600');
                
                // Update role
                roleField.value = 'customer';
            });
            
            // Mechanic tab click
            mechanicTab.addEventListener('click', function() {
                // Update tabs
                mechanicTab.classList.add('bg-white', 'shadow-sm', 'text-gray-900');
                mechanicTab.classList.remove('text-gray-600');
                customerTab.classList.remove('bg-white', 'shadow-sm', 'text-gray-900');
                customerTab.classList.add('text-gray-600');
                
                // Update role
                roleField.value = 'mechanic';
            });
        });
        
        // Password visibility toggle - unchanged
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    </svg>
                `;
            } else {
                passwordInput.type = 'password';
                toggleButton.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                `;
            }
        }
    </script>

</body>
</html>

<?php
// Clear session data exactly like first file
unset($_SESSION['form_data']);
unset($_SESSION['otp']);
unset($_SESSION['errors']);
?>