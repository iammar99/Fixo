<?php
// Get user data from session
$user_data = $_SESSION["user"] ?? [];


if (empty($user_data)) {
    echo "<div class='p-4 bg-red-100 text-red-700 rounded'>Error: No user data</div>";
    return;
}
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Profile Header -->
    <div class="bg-gradient-to-r from-fixo-orange to-orange-600 rounded-2xl p-6 md:p-8 text-white mb-8">
        <div class="flex flex-col md:flex-row items-center md:items-start justify-between">
            <div class="flex items-center mb-6 md:mb-0">
                <div
                    class="w-24 h-24 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-3xl font-bold border-4 border-white/30">
                    <?php echo strtoupper(substr($user_data['name'], 0, 1)); ?>
                </div>
                <div class="ml-6">
                    <h1 class="text-3xl font-bold"><?php echo htmlspecialchars($user_data['name']); ?></h1>
                    <p class="text-orange-100 mt-1">Service Provider</p>
                    <p class="text-orange-100 mt-2">
                        <i class="fas fa-wrench mr-2"></i>
                        <?php echo htmlspecialchars($user_data['service'] ?? 'General Mechanic'); ?>
                    </p>
                </div>
            </div>
            <div class="text-center md:text-right">
                <div class="inline-flex items-center bg-white/30 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                    <i
                        class="fas fa-circle <?php echo ($user_data['availability'] == 1) ? 'text-green-400' : 'text-red-400'; ?> mr-2"></i>
                    <span class="font-semibold">
                        <?php echo ($user_data['availability'] == "available") ? 'Available' : 'Not Available'; ?>
                    </span>
                </div>
                <br>
                <button class="edit-btn bg-white text-orange-600 font-semibold py-3 px-6 rounded-xl hover:bg-orange-50">
                    <i class="fas fa-edit mr-2"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-tools text-orange-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Service</p>
                    <p class="text-2xl font-bold text-gray-800">
                        <?php echo htmlspecialchars($user_data['service'] ?? 'Mechanic'); ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-star text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Rating</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $user_data['rating'] ?? 'N/A'; ?></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-toggle-on text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Availability</p>
                    <p class="text-2xl font-bold text-gray-800">
                        <?php echo ($user_data['availability'] == "available") ? 'Yes' : 'No'; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-user-shield text-purple-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Status</p>
                    <p class="text-2xl font-bold text-gray-800">
                        <?php echo ($user_data['status'] == 0) ? 'Active' : 'Inactive'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Professional Information -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-id-card text-fixo-orange mr-3"></i>
                Professional Information
            </h2>
            <div class="space-y-4">
                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-tools text-orange-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Specialization</p>
                        <p class="font-medium"><?php echo htmlspecialchars($user_data['service'] ?? 'Not specified'); ?>
                        </p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-star text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Rating</p>
                        <p class="font-medium"><?php echo $user_data['rating'] ?? 'Not rated'; ?></p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-toggle-on text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Availability</p>
                        <p class="font-medium">
                            <?php if ($user_data['availability'] == "available"): ?>
                                <span class="text-green-600">✅ Available for work</span>
                            <?php else: ?>
                                <span class="text-red-600">⛔ Not available</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-address-book text-fixo-orange mr-3"></i>
                Contact Information
            </h2>
            <div class="space-y-4">
                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-envelope text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email Address</p>
                        <p class="font-medium"><?php echo htmlspecialchars($user_data['email']); ?></p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-phone text-teal-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Phone Number</p>
                        <p class="font-medium"><?php echo htmlspecialchars($user_data['phone'] ?? 'Not provided'); ?>
                        </p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-map-marker-alt text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Address</p>
                        <p class="font-medium"><?php echo htmlspecialchars($user_data['address'] ?? 'Not provided'); ?>
                        </p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user-cog text-red-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Account Type</p>
                        <p class="font-medium">
                            <?php if ($user_data['isAdmin'] == 1): ?>
                                <span class="text-red-600 font-bold">Admin Provider</span>
                            <?php else: ?>
                                <span class="text-gray-600">Regular Provider</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Profile Modal -->
<div id="editProfileModal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-2xl bg-white">
        <!-- Modal Header -->
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-edit text-fixo-orange mr-2"></i>
                Edit Profile
            </h3>
            <button id="closeModal" class="text-gray-400 hover:text-gray-600 text-2xl">
                &times;
            </button>
        </div>

        <!-- Modal Body -->
        <div class="mt-6">
            <form id="editProfileForm" action="Proccessing_pages/Profile/edit-provider-profile.php" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-blue-600 mr-2"></i>Username
                        </label>
                        <input type="text" id="username" name="name" required
                            value="<?php echo htmlspecialchars( $user_data['name'] ?? ''); ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fixo-orange focus:border-transparent transition"
                            placeholder="Enter username">
                        <p class="text-xs text-gray-500 mt-1">This will be your display name</p>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-phone text-teal-600 mr-2"></i>Phone Number
                        </label>
                        <input type="tel" id="phone" name="phone" required
                            value="<?php echo htmlspecialchars($user_data['phone'] ?? ''); ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fixo-orange focus:border-transparent transition"
                            placeholder="Enter phone number">
                    </div>

                    <!-- Service/Specialization -->
                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tools text-orange-600 mr-2"></i>Specialization
                        </label>
                        <select id="service" name="service" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fixo-orange focus:border-transparent transition appearance-none bg-white">
                            <option value="">Select your specialization</option>

                            <!-- Engine Repair options -->
                            <option value="engine" <?php
                                $current = strtolower($user_data['service'] ?? '');
                                echo (in_array($current, ['engine', 'engine repair', 'mechanic'])) ? 'selected' : '';
                                ?>>
                                Engine Repair
                            </option>

                            <!-- Electrical Systems options -->
                            <option value="electrical" <?php
                                $current = strtolower($user_data['service'] ?? '');
                                echo (in_array($current, ['electrical', 'electrical systems', 'electrician'])) ? 'selected' : '';
                                ?>>
                                Electrical Systems
                            </option>

                            <!-- Battery Services options -->
                            <option value="battery" <?php
                                $current = strtolower($user_data['service'] ?? '');
                                echo (in_array($current, ['battery', 'battery services'])) ? 'selected' : '';
                                ?>>
                                Battery Services
                            </option>

                            <!-- Tire / Puncture options -->
                            <option value="tire" <?php
                                $current = strtolower($user_data['service'] ?? '');
                                echo (in_array($current, ['tire', 'tire / puncture', 'tire/puncture'])) ? 'selected' : '';
                                ?>>
                                Tire / Puncture
                            </option>

                            <!-- General Mechanic options -->
                            <option value="general" <?php
                                $current = strtolower($user_data['service'] ?? '');
                                echo (in_array($current, ['general', 'general mechanic', 'mechanic'])) ? 'selected' : '';
                                ?>>
                                General Mechanic
                            </option>

                            <!-- Brake Service options -->
                            <option value="brake" <?php
                                $current = strtolower($user_data['service'] ?? '');
                                echo (in_array($current, ['brake', 'brake service'])) ? 'selected' : '';
                                ?>>
                                Brake Service
                            </option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>Address
                        </label>
                        <textarea id="address" name="address" rows="3" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fixo-orange focus:border-transparent transition"
                            placeholder="Enter your full address"><?php echo htmlspecialchars($user_data['address'] ?? ''); ?></textarea>
                    </div>
                </div>

                <!-- Hidden fields for security -->
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>">

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-4 mt-8 pt-4 border-t">
                    <button type="button" id="cancelEdit"
                        class="px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-300 transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-6 py-3 bg-fixo-orange text-white font-medium rounded-xl hover:bg-orange-600 transition flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- JavaScript for modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editBtn = document.querySelector('.edit-btn');
            const modal = document.getElementById('editProfileModal');
            const closeBtn = document.getElementById('closeModal');
            const cancelBtn = document.getElementById('cancelEdit');

            // Open modal
            editBtn.addEventListener('click', function () {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            });

            // Close modal functions
            function closeModal() {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);

            // Close modal when clicking outside
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });

            // Form submission feedback (optional)
            const form = document.getElementById('editProfileForm');
            form.addEventListener('submit', function () {
                // You could add loading state here
                this.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';
            });
        });
    </script>
</div>