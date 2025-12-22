<?php
$pageTitle = "Home";
session_start();
$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
$success_message = $_SESSION['success_message'] ?? '';

if (isset($_GET['type']) && in_array($_GET['type'], ['client', 'provider'])) {
    $registeration_type = $_GET['type'];
    $_SESSION['registeration_type'] = $registeration_type;
} else {
    $registeration_type = $_SESSION["registeration_type"] ?? "client";
}

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
    header("Location:/");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Fixo | Mobile Mechanic Service</title>
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
        html,
        body {
            height: 100%;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .min-h-screen {
            min-height: 100vh;
            height: 100vh;
        }

        @media (max-width: 767px) {
            .min-h-screen {
                height: auto;
                min-height: 100vh;
            }

            html,
            body {
                overflow-y: auto;
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

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

    <div class="min-h-screen flex flex-col md:flex-row">
        <div class="md:hidden bg-gradient-to-br from-fixo-orange to-orange-600 text-white p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mr-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">Fixo</span>
                </div>
                <div class="text-sm font-medium">Join Fixo</div>
            </div>
        </div>

        <div class="hidden md:block md:w-1/2 bg-gradient-to-br from-fixo-orange to-orange-600 text-white p-6 md:p-8">
            <div class="h-full flex flex-col justify-center max-w-sm mx-auto">
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">Fixo</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold mb-4">Join Fixo Community</h1>
                    <p class="text-orange-100">Get started with mobile vehicle repair services</p>
                </div>

                <div class="space-y-4 mt-8">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold mb-1">For Customers</h3>
                            <p class="text-orange-100 text-sm">Book certified mechanics at your location</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold mb-1">For Mechanics</h3>
                            <p class="text-orange-100 text-sm">Earn more with flexible mobile services</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold mb-1">Secure Platform</h3>
                            <p class="text-orange-100 text-sm">Verified users and secure transactions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 p-4 md:p-6 overflow-y-auto md:w-1/2">
            <div class="max-w-md mx-auto md:transform md:scale-95 md:origin-top">

                <div class="mb-4">
                    <h2 class="text-xl font-bold text-gray-900 mb-1 md:text-2xl">Create Account</h2>
                    <p class="text-gray-600 text-sm">Join Fixo as a customer or mechanic</p>
                </div>

                <div class="mb-6">
                    <div class="flex bg-gray-100 rounded-lg p-1">
                        <button id="customer-tab"
                            class="flex-1 py-2 px-3 rounded-lg font-medium transition-all duration-300 text-sm <?php echo ($registeration_type == 'client') ? 'bg-white shadow-sm text-gray-900' : 'text-gray-600 hover:text-gray-900'; ?>">
                            Register as Customer
                        </button>
                        <button id="mechanic-tab"
                            class="flex-1 py-2 px-3 rounded-lg font-medium transition-all duration-300 text-sm <?php echo ($registeration_type == 'provider') ? 'bg-white shadow-sm text-gray-900' : 'text-gray-600 hover:text-gray-900'; ?>">
                            Register as Mechanic
                        </button>
                    </div>
                </div>

                <form action="Proccessing_pages/Registeration/client_proccessing.php" method="POST" id="customer-form"
                    class="space-y-4 <?php echo ($registeration_type == 'provider') ? 'hidden' : ''; ?>">
                    <input type="hidden" name="role" value="customer">

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Email </label>
                        <input type="email" name="email"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <input type="password" name="password" required id="customer-password"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 pr-10 text-sm">
                            <button type="button" onclick="togglePassword('customer-password', 'customer-toggle')"
                                id="customer-toggle" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" name="confirm_password" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Address</label>
                        <textarea rows="2" name="address" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 resize-none text-sm"></textarea>
                        <p class="text-xs text-gray-500 mt-1">Where do you need mechanic services?</p>
                    </div>

                    <button type="submit"
                        class="w-full py-2 bg-fixo-orange text-white font-medium rounded-lg hover:bg-orange-600 transition-all duration-300 focus:outline-none focus:ring-1 focus:ring-orange-500 focus:ring-offset-1 text-sm">
                        Create Customer Account
                    </button>
                </form>

                <form action="Proccessing_pages/Registeration/provider_proccessing.php" method="POST" id="mechanic-form"
                    class="space-y-4 <?php echo ($registeration_type == 'client') ? 'hidden' : ''; ?>">
                    <input type="hidden" name="role" value="mechanic">

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <input type="password" name="password" required id="mechanic-password"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 pr-10 text-sm">
                            <button type="button" onclick="togglePassword('mechanic-password', 'mechanic-toggle')"
                                id="mechanic-toggle" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" name="confirm_password" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Service Category</label>
                        <select required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 appearance-none bg-white text-sm"
                            name="service_specialist">
                            <option value="">Select your specialization</option>
                            <option value="engine">Engine Repair</option>
                            <option value="electrical">Electrical Systems</option>
                            <option value="battery">Battery Services</option>
                            <option value="tire">Tire / Puncture</option>
                            <option value="general">General Mechanic</option>
                            <option value="brake">Brake Service</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Experience (Years)</label>
                        <input type="number" min="0" max="50" name="experience" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Service Area</label>
                        <input type="text" name="address" required
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm"
                            placeholder="e.g., People Colony, Canal Road, Jhang Road">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">CNIC (Optional)</label>
                        <input type="text" name="cnic"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-fixo-orange focus:ring-1 focus:ring-orange-100 focus:outline-none transition-all duration-300 text-sm"
                            placeholder="For verification purposes">
                    </div>

                    <button type="submit"
                        class="w-full py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all duration-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:ring-offset-1 text-sm">
                        Register as Mechanic
                    </button>
                </form>

                <div class="mt-6 pt-4 border-t border-gray-200 text-center">
                    <p class="text-gray-600 text-sm">
                        Already have an account?
                        <a href="login.php"
                            class="text-fixo-orange font-medium hover:text-orange-600 transition-colors ml-1">Login</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const customerTab = document.getElementById('customer-tab');
            const mechanicTab = document.getElementById('mechanic-tab');
            const customerForm = document.getElementById('customer-form');
            const mechanicForm = document.getElementById('mechanic-form');

            const initialType = "<?php echo $registeration_type; ?>";
            
            if (initialType === 'provider') {
                customerTab.classList.remove('bg-white', 'shadow-sm', 'text-gray-900');
                customerTab.classList.add('text-gray-600');
                mechanicTab.classList.add('bg-white', 'shadow-sm', 'text-gray-900');
                mechanicTab.classList.remove('text-gray-600');
            } else {
                customerTab.classList.add('bg-white', 'shadow-sm', 'text-gray-900');
                customerTab.classList.remove('text-gray-600');
                mechanicTab.classList.remove('bg-white', 'shadow-sm', 'text-gray-900');
                mechanicTab.classList.add('text-gray-600');
            }

            customerTab.addEventListener('click', function() {
                customerTab.classList.add('bg-white', 'shadow-sm', 'text-gray-900');
                customerTab.classList.remove('text-gray-600');
                mechanicTab.classList.remove('bg-white', 'shadow-sm', 'text-gray-900');
                mechanicTab.classList.add('text-gray-600');

                customerForm.classList.remove('hidden');
                mechanicForm.classList.add('hidden');
            });

            mechanicTab.addEventListener('click', function() {
                mechanicTab.classList.add('bg-white', 'shadow-sm', 'text-gray-900');
                mechanicTab.classList.remove('text-gray-600');
                customerTab.classList.remove('bg-white', 'shadow-sm', 'text-gray-900');
                customerTab.classList.add('text-gray-600');

                mechanicForm.classList.remove('hidden');
                customerForm.classList.add('hidden');
            });
        });

        function togglePassword(passwordId, toggleId) {
            const passwordInput = document.getElementById(passwordId);
            const toggleButton = document.getElementById(toggleId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    </svg>
                `;
            } else {
                passwordInput.type = 'password';
                toggleButton.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                `;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');

            forms.forEach(form => {
                const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
                const submitButton = form.querySelector('button[type="submit"]');

                function checkForm() {
                    let allFilled = true;
                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            allFilled = false;
                        }
                    });

                    if (allFilled) {
                        submitButton.disabled = false;
                        submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    } else {
                        submitButton.disabled = true;
                        submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                    }
                }

                checkForm();

                inputs.forEach(input => {
                    input.addEventListener('input', checkForm);
                    input.addEventListener('change', checkForm);
                });
            });
        });

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
    </script>

    <?php
    require_once "./includes/components/footer.php";
    unset($_SESSION['form_data']);
    unset($_SESSION['otp']);
    unset($_SESSION['errors']);
    unset($_SESSION['registeration_type']);
    ?>