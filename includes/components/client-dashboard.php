<?php
$pageTitle = "Home";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "./includes/components/header.php";
require_once __DIR__ . "/../../Proccessing_pages/Dashboard/dashboard-client_proccessing.php";

if (isset($_SESSION["success_message"]) && $_SESSION["success_message"] == true) {
    $success_message = $_SESSION["success_message"];
}

// Sample mechanics data - Replace with your database query
// $mechanics = [
//     [
//         'id' => 1,
//         'name' => 'John Smith',
//         'rating' => 4.8,
//         'reviews' => 127,
//         'distance' => '2.3 km',
//         'price' => 50,
//         'specialization' => 'Engine Specialist',
//         'experience' => '8 years',
//         'availability' => 'available',
//         'avatar' => 'https://i.pravatar.cc/150?img=1'
//     ],
//     [
//         'id' => 2,
//         'name' => 'Mike Johnson',
//         'rating' => 4.9,
//         'reviews' => 203,
//         'distance' => '1.8 km',
//         'price' => 65,
//         'specialization' => 'Transmission Expert',
//         'experience' => '12 years',
//         'availability' => 'available',
//         'avatar' => 'https://i.pravatar.cc/150?img=2'
//     ],
//     [
//         'id' => 3,
//         'name' => 'David Brown',
//         'rating' => 4.7,
//         'reviews' => 89,
//         'distance' => '3.5 km',
//         'price' => 45,
//         'specialization' => 'Electrical Systems',
//         'experience' => '6 years',
//         'availability' => 'busy',
//         'avatar' => 'https://i.pravatar.cc/150?img=3'
//     ],
//     [
//         'id' => 4,
//         'name' => 'Robert Wilson',
//         'rating' => 4.6,
//         'reviews' => 156,
//         'distance' => '4.2 km',
//         'price' => 55,
//         'specialization' => 'Brake Systems',
//         'experience' => '10 years',
//         'availability' => 'available',
//         'avatar' => 'https://i.pravatar.cc/150?img=4'
//     ],
//     [
//         'id' => 5,
//         'name' => 'James Martinez',
//         'rating' => 4.9,
//         'reviews' => 245,
//         'distance' => '1.2 km',
//         'price' => 70,
//         'specialization' => 'All-Round Expert',
//         'experience' => '15 years',
//         'availability' => 'available',
//         'avatar' => 'https://i.pravatar.cc/150?img=5'
//     ],
//     [
//         'id' => 6,
//         'name' => 'Chris Anderson',
//         'rating' => 4.5,
//         'reviews' => 72,
//         'distance' => '5.1 km',
//         'price' => 40,
//         'specialization' => 'Oil & Filters',
//         'experience' => '4 years',
//         'availability' => 'available',
//         'avatar' => 'https://i.pravatar.cc/150?img=6'
//     ],
// ];


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



<div class="min-h-screen bg-fixo-dark">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-fixo-orange to-amber-600 px-6 py-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <button onclick="window.history.back()"
                    class="text-white p-2 hover:bg-white/20 rounded-lg transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <h1 class="text-2xl font-bold text-white">Book a Mechanic</h1>
                <button class="text-white p-2 hover:bg-white/20 rounded-lg transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </button>
            </div>
            <!-- Search Bar -->
            <div class="relative">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search by specialization, name, address..."
                        class="w-full px-4 py-3 pl-12 rounded-lg bg-white/20 backdrop-blur-sm text-white placeholder-white/70 border border-white/30 focus:outline-none focus:ring-2 focus:ring-white/50" />
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-white/70" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <button id="clearSearch"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white hidden">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <!-- <div class="bg-gray-800 px-6 py-4 border-b border-gray-700">
        <div class="max-w-7xl mx-auto flex gap-3 overflow-x-auto pb-2">
            <button class="px-4 py-2 rounded-full bg-fixo-orange text-white font-medium whitespace-nowrap">
                All Mechanics
            </button>
            <button
                class="px-4 py-2 rounded-full bg-gray-700 text-gray-300 hover:bg-gray-600 font-medium whitespace-nowrap transition-all">
                Nearest
            </button>
            <button
                class="px-4 py-2 rounded-full bg-gray-700 text-gray-300 hover:bg-gray-600 font-medium whitespace-nowrap transition-all">
                Top Rated
            </button>
            <button
                class="px-4 py-2 rounded-full bg-gray-700 text-gray-300 hover:bg-gray-600 font-medium whitespace-nowrap transition-all">
                Budget Friendly
            </button>
        </div>
    </div> -->

    <!-- Mechanics List -->
    <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="mb-4 flex items-center justify-between">
            <p class="text-gray-400 text-sm">
                <span id="mechanicsCount"><?php echo count($mechanics); ?></span> mechanics total
                <span id="searchResultsText" class="hidden"> matching your search</span>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="mechanicsGrid">
            <?php foreach ($mechanics as $mechanic): ?>
                <div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700 hover:border-fixo-orange transition-all duration-300 hover:shadow-xl hover:shadow-fixo-orange/20 mechanic-card"
                    data-name="<?php echo strtolower(htmlspecialchars($mechanic['name'])); ?>"
                    data-service="<?php echo strtolower(htmlspecialchars($mechanic['service'] ?? '')); ?>"
                    data-address="<?php echo strtolower(htmlspecialchars($mechanic['address'] ?? '')); ?>">
                    <!-- Header with Avatar and Status -->
                    <div class="relative p-6 pb-4">
                        <div class="flex items-start gap-4">
                            <div class="relative">
                                <div
                                    class="w-16 h-16 rounded-full border-2 border-fixo-orange bg-fixo-orange flex items-center justify-center text-white text-2xl font-bold">
                                    <?php echo strtoupper(substr($mechanic['name'], 0, 1)); ?>
                                </div>

                                <?php if ($mechanic['availability'] === 'available'): ?>
                                    <div
                                        class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 rounded-full border-2 border-gray-800">
                                    </div>
                                <?php elseif ($mechanic['availability'] === 'busy'): ?>
                                    <div
                                        class="absolute bottom-0 right-0 w-4 h-4 bg-red-500 rounded-full border-2 border-gray-800">
                                    </div>
                                <?php else: ?>
                                    <div
                                        class="absolute bottom-0 right-0 w-4 h-4 bg-gray-500 rounded-full border-2 border-gray-800">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="flex-1">
                                <h3 class="text-white font-bold text-lg mb-1">
                                    <?php echo htmlspecialchars($mechanic['name']); ?>
                                </h3>
                                <p class="text-fixo-orange text-sm font-medium">
                                    <?php echo htmlspecialchars($mechanic['service'] ?? 'General Service'); ?>
                                </p>
                            </div>
                            <!-- Heart -->
                            <!-- <button class="text-gray-400 hover:text-fixo-orange transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </button> -->
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="px-6 pb-4 flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            <span
                                class="text-white font-semibold"><?php echo number_format($mechanic['rating'], 1); ?></span>
                            <span class="text-gray-400">rating</span>
                        </div>

                        <?php if (!empty($mechanic['phone'])): ?>
                            <div class="flex items-center gap-1 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span><?php echo htmlspecialchars($mechanic['phone']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Address Badge -->
                    <?php if (!empty($mechanic['address'])): ?>
                        <div class="px-6 pb-4">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 bg-fixo-blue/20 rounded-full border border-fixo-blue/30">
                                <svg class="w-4 h-4 text-fixo-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span
                                    class="text-fixo-blue text-xs font-medium truncate max-w-[200px]"><?php echo htmlspecialchars($mechanic['address']); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Member Since -->
                    <div class="px-6 pb-4">
                        <p class="text-gray-500 text-xs">Member since
                            <?php echo date('M Y', strtotime($mechanic['createdat'])); ?>
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-6 pb-6 flex items-center justify-between gap-3">
                        <!-- Contact Button -->
                        <a href="tel:<?php echo htmlspecialchars($mechanic['phone']); ?>"
                            class="flex-1 bg-fixo-blue/20 hover:bg-fixo-blue/30 text-fixo-blue px-4 py-3 rounded-lg font-semibold transition-all duration-300 text-center border border-fixo-blue/30">
                            Call
                        </a>

                        <!-- Select/Status Button -->
                        <?php if ($mechanic['availability'] === 'available' && $mechanic['status'] == 0): ?>
                            <button
                                onclick="selectMechanic(<?php echo $mechanic['id']; ?>, '<?php echo htmlspecialchars($mechanic['name'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($mechanic['phone'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($mechanic['service'] ?? 'General Service', ENT_QUOTES); ?>')"
                                class="flex-1 bg-fixo-orange hover:bg-orange-600 text-white px-4 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                Select
                            </button>
                        <?php elseif ($mechanic['availability'] === 'busy'): ?>
                            <button disabled
                                class="flex-1 bg-gray-700 text-gray-500 px-4 py-3 rounded-lg font-semibold cursor-not-allowed">
                                Busy
                            </button>
                        <?php elseif ($mechanic['availability'] === 'offline'): ?>
                            <button disabled
                                class="flex-1 bg-gray-700 text-gray-500 px-4 py-3 rounded-lg font-semibold cursor-not-allowed">
                                Offline
                            </button>
                        <?php elseif ($mechanic['status'] == 1): ?>
                            <button disabled
                                class="flex-1 bg-gray-700 text-gray-500 px-4 py-3 rounded-lg font-semibold cursor-not-allowed">
                                Inactive
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Booking Modal (Hidden by default) -->
<div id="bookingModal"
    class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-gray-800 rounded-2xl max-w-md w-full p-6 border border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">Confirm Booking</h2>
            <button onclick="closeModal()" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-4 mb-6">
            <div class="bg-gray-700/50 rounded-lg p-4">
                <p class="text-gray-400 text-sm mb-1">Mechanic</p>
                <p class="text-white font-semibold text-lg" id="modalMechanicName"></p>
            </div>

            <div class="bg-gray-700/50 rounded-lg p-4">
                <p class="text-gray-400 text-sm mb-1">Phone Number</p>
                <p class="text-fixo-orange font-bold text-2xl" id="modelPhone"></p>
            </div>

            <div class="bg-gray-700/50 rounded-lg p-4">
                <label class="text-gray-400 text-sm mb-2 block">Describe your issue</label>
                <textarea
                    class="w-full bg-gray-800 text-white rounded-lg p-3 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-fixo-orange resize-none"
                    rows="3" placeholder="e.g., Engine making strange noise..."></textarea>
            </div>
        </div>

        <button onclick="confirmBooking()"
            class="w-full bg-fixo-orange hover:bg-orange-600 text-white py-4 rounded-lg font-bold text-lg transition-all duration-300 transform hover:scale-105">
            Confirm & Book Now
        </button>
    </div>
</div>

<script>
    let selectedMechanicId = null;

    function selectMechanic(id, name, price) {
        selectedMechanicId = id;
        document.getElementById('modalMechanicName').textContent = name;
        document.getElementById('modelPhone').textContent = price;
        document.getElementById('bookingModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('bookingModal').classList.add('hidden');
        selectedMechanicId = null;
    }

    function confirmBooking() {
        if (selectedMechanicId) {
            // Add your booking logic here
            alert('Booking confirmed for mechanic ID: ' + selectedMechanicId);
            // Redirect to booking confirmation page
            // window.location.href = '/booking-confirmation.php?mechanic_id=' + selectedMechanicId;
        }
    }

    // Close modal when clicking outside
    document.getElementById('bookingModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>


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

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const clearSearchBtn = document.getElementById('clearSearch');
    const mechanicsCount = document.getElementById('mechanicsCount');
    const searchResultsText = document.getElementById('searchResultsText');
    const mechanicCards = document.querySelectorAll('.mechanic-card');

    function filterMechanics() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        mechanicCards.forEach(card => {
            const name = card.getAttribute('data-name');
            const service = card.getAttribute('data-service');
            const address = card.getAttribute('data-address');

            const matches = name.includes(searchTerm) ||
                service.includes(searchTerm) ||
                address.includes(searchTerm);

            if (matches || searchTerm === '') {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        mechanicsCount.textContent = visibleCount;

        if (searchTerm !== '') {
            searchResultsText.classList.remove('hidden');
        } else {
            searchResultsText.classList.add('hidden');
        }

        if (searchTerm !== '') {
            clearSearchBtn.classList.remove('hidden');
        } else {
            clearSearchBtn.classList.add('hidden');
        }
    }

    searchInput.addEventListener('input', filterMechanics);

    clearSearchBtn.addEventListener('click', function () {
        searchInput.value = '';
        filterMechanics();
        searchInput.focus();
    });

    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            filterMechanics();
        }
    });

    filterMechanics();

</script>

<?php
require_once "./includes/components/footer.php";
unset($success_message);
unset($_SESSION["success_message"]);

?>