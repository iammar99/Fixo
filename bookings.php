<?php
require_once __DIR__ . "/Config/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (
    !isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false ||
    !isset($_SESSION["user_type"]) || $_SESSION["user_type"] != "providers"
) {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

require_once __DIR__ . "/Proccessing_pages/Dashboard/dashboard-provider-proccessing.php";
require_once __DIR__ . "/includes/components/header.php";
$user_data = $_SESSION["user"] ?? [];

if (empty($user_data)) {
    echo "<div class='p-4 bg-red-100 text-red-700 rounded'>Error: No user data</div>";
    return;
}
?>

<!-- Bookings Page -->
<div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6 lg:py-8">
    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="order-2 sm:order-1">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Bookings</h1>
                <p class="text-gray-600 mt-1 sm:mt-2 text-sm sm:text-base">Manage all your customer bookings</p>
            </div>
            <div class="order-1 sm:order-2 w-full sm:w-auto">
                <div class="relative">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search by customer, problem type..."
                            class="w-full sm:w-64 px-4 py-2 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-fixo-orange focus:border-transparent text-sm sm:text-base">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <button id="clearSearch"
                            class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 hidden">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Stats Tabs - Mobile Scrollable -->
        <div class="flex border-b border-gray-200 mt-4 sm:mt-6 overflow-x-auto scrollbar-hide" id="statusTabs">
            <button data-status="all"
                class="px-3 sm:px-6 py-2 sm:py-3 border-b-2 border-fixo-orange text-fixo-orange font-medium whitespace-nowrap text-sm sm:text-base">
                All (<?php echo count($recent_bookings); ?>)
            </button>
            <button data-status="pending"
                class="px-3 sm:px-6 py-2 sm:py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap text-sm sm:text-base">
                Pending (<?php echo count(array_filter($recent_bookings, fn($b) => $b['status'] === 'pending')); ?>)
            </button>
            <button data-status="accepted"
                class="px-3 sm:px-6 py-2 sm:py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap text-sm sm:text-base">
                Accepted (<?php echo count(array_filter($recent_bookings, fn($b) => $b['status'] === 'accepted')); ?>)
            </button>
            <button data-status="in_progress"
                class="px-3 sm:px-6 py-2 sm:py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap text-sm sm:text-base">
                In Progress
                (<?php echo count(array_filter($recent_bookings, fn($b) => $b['status'] === 'in_progress')); ?>)
            </button>
            <button data-status="completed"
                class="px-3 sm:px-6 py-2 sm:py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap text-sm sm:text-base">
                Completed (<?php echo count(array_filter($recent_bookings, fn($b) => $b['status'] === 'completed')); ?>)
            </button>
            <button data-status="cancelled"
                class="px-3 sm:px-6 py-2 sm:py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap text-sm sm:text-base">
                Cancelled (<?php echo count(array_filter($recent_bookings, fn($b) => $b['status'] === 'cancelled')); ?>)
            </button>
        </div>
    </div>

    <!-- Search Results Info -->
    <div id="searchResultsInfo" class="mb-4 p-3 bg-blue-50 rounded-lg hidden">
        <p class="text-blue-800 text-sm sm:text-base">
            Showing <span id="visibleCount">0</span> of <?php echo count($recent_bookings); ?> bookings
            <span id="searchTermText" class="hidden"> for "<strong id="currentSearchTerm"></strong>"</span>
            <button onclick="clearSearch()"
                class="ml-2 text-blue-600 hover:text-blue-800 underline text-sm sm:text-base">Clear search</button>
        </p>
    </div>

    <!-- Detailed Bookings View -->
    <div class="space-y-4 sm:space-y-6" id="bookingsContainer">
        <?php if (empty($recent_bookings)): ?>
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-6 sm:p-12 text-center">
                <div
                    class="w-16 h-16 sm:w-20 sm:h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-times text-gray-400 text-2xl sm:text-3xl"></i>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">No Bookings Found</h3>
                <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base">You don't have any bookings yet.</p>
            </div>
        <?php else: ?>
            <?php foreach ($recent_bookings as $booking): ?>
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden booking-card"
                    data-status="<?php echo $booking['status']; ?>"
                    data-customer="<?php echo strtolower(htmlspecialchars($booking['customer'])); ?>"
                    data-problem="<?php echo strtolower(htmlspecialchars($booking['problem_type'])); ?>"
                    data-description="<?php echo strtolower(htmlspecialchars($booking['problem_description'])); ?>">
                    <div class="p-4 sm:p-6">
                        <!-- Booking Header -->
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-4 sm:mb-6 gap-3">
                            <div class="order-2 sm:order-1">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                                    <h3 class="text-lg sm:text-xl font-bold text-gray-900">Booking
                                        #<?php echo $booking['id']; ?></h3>
                                    <span class="ml-0 sm:ml-4 px-3 py-1 rounded-full text-xs font-medium 
                                    <?php
                                    if ($booking['status'] == 'completed')
                                        echo 'bg-green-100 text-green-800';
                                    elseif ($booking['status'] == 'accepted' || $booking['status'] == 'confirmed')
                                        echo 'bg-blue-100 text-blue-800';
                                    elseif ($booking['status'] == 'in_progress')
                                        echo 'bg-yellow-100 text-yellow-800';
                                    elseif ($booking['status'] == 'cancelled')
                                        echo 'bg-red-100 text-red-800';
                                    else
                                        echo 'bg-gray-100 text-gray-800';
                                    ?>">
                                        <?php echo ucfirst(str_replace('_', ' ', $booking['status'])); ?>
                                    </span>
                                </div>
                                <p class="text-gray-600 mt-1 text-sm">
                                    <i class="far fa-clock mr-1"></i>
                                    <?php echo (new DateTime($booking['created_at']))->format('M d, Y \a\t h:i A'); ?>
                                </p>
                            </div>
                            <div class="order-1 sm:order-2 flex flex-wrap gap-2">
                                <?php if ($booking['status'] == 'pending'): ?>
                                    <!-- Accept Form -->
                                    <form action="Proccessing_pages/Dashboard/update_booking_status.php" method="POST"
                                        class="inline">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit"
                                            class="px-3 sm:px-4 py-1.5 sm:py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium text-sm sm:text-base w-full sm:w-auto">
                                            Accept
                                        </button>
                                    </form>

                                    <!-- Reject Form -->
                                    <form action="Proccessing_pages/Dashboard/update_booking_status.php" method="POST"
                                        class="inline">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit"
                                            class="px-3 sm:px-4 py-1.5 sm:py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium text-sm sm:text-base w-full sm:w-auto">
                                            Reject
                                        </button>
                                    </form>

                                <?php elseif ($booking['status'] == 'accepted'): ?>
                                    <!-- Start Job Form -->
                                    <form action="Proccessing_pages/Dashboard/update_booking_status.php" method="POST"
                                        class="inline">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <input type="hidden" name="status" value="in_progress">
                                        <button type="submit"
                                            class="px-3 sm:px-4 py-1.5 sm:py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium text-sm sm:text-base w-full sm:w-auto">
                                            Start Job
                                        </button>
                                    </form>

                                <?php elseif ($booking['status'] == 'in_progress'): ?>
                                    <!-- Complete Form -->
                                    <form action="Proccessing_pages/Dashboard/update_booking_status.php" method="POST"
                                        class="inline">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit"
                                            class="px-3 sm:px-4 py-1.5 sm:py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium text-sm sm:text-base w-full sm:w-auto">
                                            Mark Complete
                                        </button>
                                    </form>

                                <?php endif; ?>

                            </div>
                        </div>

                        <!-- Customer & Problem Info -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                            <!-- Customer Info -->
                            <div class="bg-gray-50 rounded-lg sm:rounded-xl p-3 sm:p-4">
                                <h4 class="font-bold text-gray-800 mb-2 sm:mb-3 flex items-center text-sm sm:text-base">
                                    <i class="fas fa-user mr-2 text-fixo-orange"></i> Customer Information
                                </h4>
                                <div class="space-y-2 sm:space-y-3">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-fixo-orange flex items-center justify-center text-white font-bold mr-2 sm:mr-3 text-sm sm:text-base">
                                            <?php echo strtoupper(substr($booking['customer'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm sm:text-base">
                                                <?php echo $booking['customer']; ?></p>
                                            <p class="text-xs sm:text-sm text-gray-500">Customer</p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs sm:text-sm text-gray-500">Contact</p>
                                        <p class="font-medium text-sm">Phone: Available on request</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Problem Details -->
                            <div class="bg-gray-50 rounded-lg sm:rounded-xl p-3 sm:p-4 lg:col-span-2">
                                <h4 class="font-bold text-gray-800 mb-2 sm:mb-3 flex items-center text-sm sm:text-base">
                                    <i class="fas fa-car mr-2 text-fixo-orange"></i> Service Details
                                </h4>
                                <div class="space-y-3 sm:space-y-4">
                                    <div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-1">Problem Type</p>
                                        <p class="font-medium text-base sm:text-lg">
                                            <?php echo ucwords($booking['problem_type']); ?></p>
                                    </div>
                                    <div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-1">Description</p>
                                        <p class="font-medium text-sm sm:text-base">
                                            <?php echo $booking['problem_description']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline - Mobile Collapsed Version -->
                        <div class="mt-4 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200">
                            <h4 class="font-bold text-gray-800 mb-3 sm:mb-4 flex items-center text-sm sm:text-base">
                                <i class="fas fa-history mr-2 text-fixo-orange"></i> Booking Timeline
                            </h4>

                            <!-- Mobile Timeline (Stacked) -->
                            <div class="block sm:hidden space-y-4">
                                <?php
                                $timeline_steps = [
                                    [
                                        'title' => 'Booked',
                                        'icon' => 'fa-check',
                                        'color' => 'bg-green-500',
                                        'time' => (new DateTime($booking['created_at']))->format('M d, h:i A'),
                                        'active' => true
                                    ],
                                    [
                                        'title' => 'Confirmed',
                                        'icon' => $booking['status'] === 'pending' ? 'fa-clock' : 'fa-check',
                                        'color' => $booking['status'] === 'pending' ? 'bg-gray-300' : 'bg-blue-500',
                                        'status' => $booking['status'] === 'pending' ? 'Awaiting confirmation' : 'Confirmed',
                                        'active' => $booking['status'] !== 'pending'
                                    ],
                                    [
                                        'title' => 'Service',
                                        'icon' => in_array($booking['status'], ['completed', 'in_progress']) ? 'fa-tools' : 'fa-clock',
                                        'color' => in_array($booking['status'], ['completed', 'in_progress']) ? 'bg-blue-500' :
                                            ($booking['status'] === 'accepted' ? 'bg-gray-300' : 'bg-gray-200'),
                                        'status' => $booking['status'] === 'completed' ? 'Completed' :
                                            ($booking['status'] === 'in_progress' ? 'In Progress' :
                                                ($booking['status'] === 'accepted' ? 'Scheduled' : 'Not Started')),
                                        'active' => in_array($booking['status'], ['completed', 'in_progress'])
                                    ],
                                    [
                                        'title' => 'Completed',
                                        'icon' => $booking['status'] === 'completed' ? 'fa-check-double' : 'fa-flag-checkered',
                                        'color' => $booking['status'] === 'completed' ? 'bg-green-500' : 'bg-gray-200',
                                        'status' => $booking['status'] === 'completed' ? 'Job completed' : 'Pending completion',
                                        'active' => $booking['status'] === 'completed'
                                    ]
                                ];
                                ?>

                                <?php foreach ($timeline_steps as $step): ?>
                                    <div class="flex items-center">
                                        <div
                                            class="w-6 h-6 sm:w-8 sm:h-8 rounded-full <?php echo $step['color']; ?> flex items-center justify-center text-white mr-3">
                                            <i class="fas <?php echo $step['icon']; ?> text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-sm"><?php echo $step['title']; ?></p>
                                            <p class="text-xs text-gray-500">
                                                <?php echo isset($step['time']) ? $step['time'] : $step['status']; ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Desktop Timeline (Horizontal) -->
                            <div class="hidden sm:flex items-center space-x-4">
                                <div class="flex-1 flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white">
                                        <i class="fas fa-check text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">Booked</p>
                                        <p class="text-sm text-gray-500">
                                            <?php echo (new DateTime($booking['created_at']))->format('M d, h:i A'); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex-1 border-t-2 border-dashed border-gray-300"></div>

                                <div class="flex-1 flex items-center">
                                    <div class="w-8 h-8 rounded-full 
                                    <?php echo $booking['status'] === 'pending' ? 'bg-gray-300' : 'bg-blue-500'; ?> 
                                    flex items-center justify-center text-white">
                                        <i class="fas 
                                        <?php echo $booking['status'] === 'pending' ? 'fa-clock' : 'fa-check'; ?> 
                                        text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">Confirmed</p>
                                        <p class="text-sm text-gray-500">
                                            <?php echo $booking['status'] === 'pending' ? 'Awaiting confirmation' : 'Confirmed'; ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex-1 border-t-2 border-dashed border-gray-300"></div>

                                <div class="flex-1 flex items-center">
                                    <div class="w-8 h-8 rounded-full 
                                    <?php
                                    if (in_array($booking['status'], ['completed', 'in_progress']))
                                        echo 'bg-blue-500';
                                    elseif ($booking['status'] === 'accepted')
                                        echo 'bg-gray-300';
                                    else
                                        echo 'bg-gray-200';
                                    ?> 
                                    flex items-center justify-center text-white">
                                        <i class="fas 
                                        <?php
                                        if (in_array($booking['status'], ['completed', 'in_progress']))
                                            echo 'fa-tools';
                                        else
                                            echo 'fa-clock';
                                        ?> 
                                        text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">Service</p>
                                        <p class="text-sm text-gray-500">
                                            <?php
                                            if ($booking['status'] === 'completed')
                                                echo 'Completed';
                                            elseif ($booking['status'] === 'in_progress')
                                                echo 'In Progress';
                                            elseif ($booking['status'] === 'accepted')
                                                echo 'Scheduled';
                                            else
                                                echo 'Not Started';
                                            ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex-1 border-t-2 border-dashed border-gray-300"></div>

                                <div class="flex-1 flex items-center">
                                    <div class="w-8 h-8 rounded-full 
                                    <?php echo $booking['status'] === 'completed' ? 'bg-green-500' : 'bg-gray-200'; ?> 
                                    flex items-center justify-center text-white">
                                        <i class="fas 
                                        <?php echo $booking['status'] === 'completed' ? 'fa-check-double' : 'fa-flag-checkered'; ?> 
                                        text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">Completed</p>
                                        <p class="text-sm text-gray-500">
                                            <?php echo $booking['status'] === 'completed' ? 'Job completed' : 'Pending completion'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>



<script>
    // Client-side search and filtering
    const searchInput = document.getElementById('searchInput');
    const clearSearchBtn = document.getElementById('clearSearch');
    const searchResultsInfo = document.getElementById('searchResultsInfo');
    const visibleCountSpan = document.getElementById('visibleCount');
    const searchTermText = document.getElementById('searchTermText');
    const currentSearchTermSpan = document.getElementById('currentSearchTerm');
    const bookingCards = document.querySelectorAll('.booking-card');
    const statusTabs = document.querySelectorAll('#statusTabs button');

    let currentFilter = 'all';
    let currentSearchTerm = '';

    function filterBookings() {
        let visibleCount = 0;

        bookingCards.forEach(card => {
            const status = card.getAttribute('data-status');
            const customer = card.getAttribute('data-customer');
            const problem = card.getAttribute('data-problem');
            const description = card.getAttribute('data-description');

            // Apply status filter
            const statusMatches = currentFilter === 'all' || status === currentFilter;

            // Apply search filter
            const searchMatches = currentSearchTerm === '' ||
                customer.includes(currentSearchTerm) ||
                problem.includes(currentSearchTerm) ||
                description.includes(currentSearchTerm);

            if (statusMatches && searchMatches) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update UI
        updateUI(visibleCount);
    }

    function updateUI(visibleCount) {
        // Update count
        visibleCountSpan.textContent = visibleCount;

        // Show/hide search info
        if (currentSearchTerm !== '') {
            searchResultsInfo.classList.remove('hidden');
            searchTermText.classList.remove('hidden');
            currentSearchTermSpan.textContent = currentSearchTerm;
        } else if (currentFilter !== 'all') {
            searchResultsInfo.classList.remove('hidden');
            searchTermText.classList.add('hidden');
        } else {
            searchResultsInfo.classList.add('hidden');
        }

        // Show/hide clear button
        if (currentSearchTerm !== '') {
            clearSearchBtn.classList.remove('hidden');
        } else {
            clearSearchBtn.classList.add('hidden');
        }

        // Update active tab
        statusTabs.forEach(tab => {
            const status = tab.getAttribute('data-status');
            if (status === currentFilter) {
                tab.classList.add('border-b-2', 'border-fixo-orange', 'text-fixo-orange');
                tab.classList.remove('text-gray-600');
            } else {
                tab.classList.remove('border-b-2', 'border-fixo-orange', 'text-fixo-orange');
                tab.classList.add('text-gray-600');
            }
        });
    }

    // Search functionality
    if (searchInput) {
        let searchTimeout;

        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                currentSearchTerm = this.value.toLowerCase().trim();
                filterBookings();
            }, 500);
        });
    }

    // Clear search
    function clearSearch() {
        searchInput.value = '';
        currentSearchTerm = '';
        filterBookings();
        searchInput.focus();
    }

    // Status filtering
    statusTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            currentFilter = this.getAttribute('data-status');
            filterBookings();
        });
    });

    // Clear search button
    clearSearchBtn.addEventListener('click', clearSearch);

    // Initialize
    filterBookings();
</script>