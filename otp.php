<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["otp"])){
    header("Location:/");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification - Fixo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const otpInputs = document.querySelectorAll('.otp-input');

            otpInputs.forEach((input, index) => {
                input.addEventListener('input', function () {
                    if (input.value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                });
                
                // Handle backspace
                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && input.value === '' && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });
            });
        });
    </script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md border border-gray-100">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 mb-4">
                <span class="text-white text-2xl font-bold">Fixo</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Verify Your Account</h2>
            <p class="text-gray-600 mt-2">Enter the 6-digit code sent to your email</p>
        </div>

        <!-- OTP Form -->
        <form action="Proccessing_pages/Registeration/otp_proccessing.php" method="POST" class="space-y-8">
            <!-- OTP Inputs -->
            <div class="flex justify-center gap-3">
                <?php for ($i = 1; $i <= 6; $i++): ?>
                    <input type="text" 
                           name="otp<?php echo $i; ?>" 
                           maxlength="1" 
                           required 
                           class="otp-input w-14 h-14 text-center text-2xl font-bold border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all duration-200 text-gray-900">
                <?php endfor; ?>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg">
                Verify OTP
            </button>
        </form>

    </div>
</body>
</html>