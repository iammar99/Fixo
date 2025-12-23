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
    <title>OTP Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // This script handles the focus on the next input box after typing a digit
        document.addEventListener('DOMContentLoaded', function () {
            const otpInputs = document.querySelectorAll('.otp-input');

            otpInputs.forEach((input, index) => {
                input.addEventListener('input', function () {
                    if (input.value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                });
            });
        });
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Enter OTP</h2>

        <!-- OTP Form -->
        <form action="Proccessing_pages/Registeration/otp_proccessing.php" method="POST" class="space-y-6">
            <div class="flex justify-center gap-4">
                <input type="text" name="otp1" maxlength="1" required class="otp-input w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="otp2" maxlength="1" required class="otp-input w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="otp3" maxlength="1" required class="otp-input w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="otp4" maxlength="1" required class="otp-input w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="otp5" maxlength="1" required class="otp-input w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="otp6" maxlength="1" required class="otp-input w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full py-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Verify OTP</button>
        </form>

        <!-- Resend OTP Link -->
        <div class="mt-4 text-center text-sm">
            <p class="text-gray-600">Didn't receive the OTP? <a href="#" class="text-blue-500 hover:underline">Resend OTP</a></p>
        </div>
    </div>
</body>
</html>
