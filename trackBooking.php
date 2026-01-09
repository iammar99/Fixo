<?php
require_once __DIR__ . "/Proccessing_pages/Booking/dashboard-client-proccessing.php";
require_once __DIR__ . "/includes/components/header.php";

// Set default values if not set
$recent_bookings = $recent_bookings ?? [];
$status_counts = $status_counts ?? [
    'all' => 0,
    'pending' => 0,
    'accepted' => 0,
    'in_progress' => 0,
    'completed' => 0,
    'cancelled' => 0
];
?>

<!-- Show provider contact info if available -->
<?php if (isset($_SESSION['provider_contact_info'])): ?>
    <?php
    $contact_info = $_SESSION['provider_contact_info'];
    unset($_SESSION['provider_contact_info']);
    ?>
    <!-- Contact Modal -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center" id="contactModal">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Contact <?php echo htmlspecialchars($contact_info['name']); ?></h3>
                    <button onclick="document.getElementById('contactModal').remove()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-phone-alt text-gray-400 mr-3"></i>
                            <span class="font-medium"><?php echo htmlspecialchars($contact_info['phone'] ?? 'Not available'); ?></span>
                        </div>
                        <?php if (!empty($contact_info['phone'])): ?>
                        <div class="mt-2">
                            <a href="tel:<?php echo preg_replace('/\s+/', '', htmlspecialchars($contact_info['phone'])); ?>" 
                               class="inline-flex items-center px-4 py-2 bg-fixo-blue text-white rounded-lg hover:bg-blue-600">
                                <i class="fas fa-phone-alt mr-2"></i>Call Now
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-envelope text-gray-400 mr-3"></i>
                            <span class="font-medium"><?php echo htmlspecialchars($contact_info['email'] ?? 'Not available'); ?></span>
                        </div>
                        <?php if (!empty($contact_info['email'])): ?>
                        <div class="mt-2">
                            <a href="mailto:<?php echo htmlspecialchars($contact_info['email']); ?>" 
                               class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                <i class="fas fa-envelope mr-2"></i>Send Email
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button onclick="document.getElementById('contactModal').remove()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Client Bookings Page -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Bookings</h1>
                <p class="text-gray-600 mt-2">Track and manage all your service requests</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="<?php echo BASE_URL; ?>dashboard.php" 
                   class="px-4 py-2 bg-fixo-orange text-white rounded-lg hover:bg-orange-600 font-medium flex items-center">
                    <i class="fas fa-plus mr-2"></i> New Booking
                </a>
                <div class="relative">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search by provider, problem type..."
                            class="px-4 py-2 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-fixo-blue focus:border-transparent w-64">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <button id="clearSearch"
                            class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 hidden">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Tabs -->
        <div class="flex border-b border-gray-200 mt-6 overflow-x-auto" id="statusTabs">
            <button data-status="all"
                class="px-6 py-3 border-b-2 border-fixo-blue text-fixo-blue font-medium whitespace-nowrap">
                All (<?php echo $status_counts['all']; ?>)
            </button>
            <button data-status="pending"
                class="px-6 py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap">
                Pending (<?php echo $status_counts['pending']; ?>)
            </button>
            <button data-status="accepted"
                class="px-6 py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap">
                Accepted (<?php echo $status_counts['accepted']; ?>)
            </button>
            <button data-status="in_progress"
                class="px-6 py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap">
                In Progress (<?php echo $status_counts['in_progress']; ?>)
            </button>
            <button data-status="completed"
                class="px-6 py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap">
                Completed (<?php echo $status_counts['completed']; ?>)
            </button>
            <button data-status="cancelled"
                class="px-6 py-3 text-gray-600 hover:text-gray-900 font-medium whitespace-nowrap">
                Cancelled (<?php echo $status_counts['cancelled']; ?>)
            </button>
        </div>
    </div>

    <!-- Search Results Info -->
    <div id="searchResultsInfo" class="mb-4 p-3 bg-blue-50 rounded-lg hidden">
        <p class="text-blue-800">
            Showing <span id="visibleCount">0</span> of <?php echo $status_counts['all']; ?> bookings
            <span id="searchTermText" class="hidden"> for "<strong id="currentSearchTerm"></strong>"</span>
            <button onclick="clearSearch()" class="ml-2 text-blue-600 hover:text-blue-800 underline">Clear
                search</button>
        </p>
    </div>

    <!-- Detailed Bookings View -->
    <div class="space-y-6" id="bookingsContainer">
        <?php if (empty($recent_bookings)): ?>
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-plus text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Bookings Yet</h3>
                <p class="text-gray-600 mb-4">You haven't made any service requests yet.</p>
                <a href="<?php echo BASE_URL; ?>dashboard.php" 
                   class="inline-block px-6 py-3 bg-fixo-blue text-white rounded-lg hover:bg-blue-600 font-medium">
                    <i class="fas fa-plus mr-2"></i> Book a Service
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($recent_bookings as $booking): ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden booking-card"
                    data-status="<?php echo htmlspecialchars($booking['status']); ?>"
                    data-provider="<?php echo strtolower(htmlspecialchars($booking['provider_name'] ?? 'no provider')); ?>"
                    data-problem="<?php echo strtolower(htmlspecialchars($booking['problem_type'])); ?>"
                    data-description="<?php echo strtolower(htmlspecialchars($booking['problem_description'])); ?>">
                    <div class="p-6">
                        <!-- Booking Header -->
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <div class="flex items-center">
                                    <h3 class="text-xl font-bold text-gray-900">Booking #<?php echo $booking['id']; ?></h3>
                                    <span class="ml-4 px-3 py-1 rounded-full text-xs font-medium 
                                    <?php
                                    if ($booking['status'] == 'completed')
                                        echo 'bg-green-100 text-green-800';
                                    elseif ($booking['status'] == 'accepted')
                                        echo 'bg-blue-100 text-blue-800';
                                    elseif ($booking['status'] == 'in_progress')
                                        echo 'bg-yellow-100 text-yellow-800';
                                    elseif ($booking['status'] == 'cancelled')
                                        echo 'bg-red-100 text-red-800';
                                    else
                                        echo 'bg-gray-100 text-gray-800';
                                    ?>">
                                        <?php echo htmlspecialchars($booking['status_display']); ?>
                                    </span>
                                </div>
                                <p class="text-gray-600 mt-1">
                                    <i class="far fa-clock mr-1"></i>
                                    <?php echo htmlspecialchars($booking['created_at_formatted']); ?>
                                </p>
                            </div>
                            <div class="flex space-x-2">
                                <?php if ($booking['status'] == 'pending'): ?>
                                    <!-- Cancel Booking Form -->
                                    <form action="Proccessing_pages/Booking/cancel-booking.php" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-medium">
                                            <i class="fas fa-times mr-2"></i>Cancel
                                        </button>
                                    </form>
                                <?php endif; ?>
                                
                                <?php if (!empty($booking['provider_id'])): ?>
                                <!-- Contact Provider Form -->
                                <form action="Proccessing_pages/Booking/contact-provider.php" method="POST" class="inline">
                                    <input type="hidden" name="provider_id" value="<?php echo $booking['provider_id']; ?>">
                                    <button type="submit"
                                        class="px-4 py-2 bg-fixo-blue text-white rounded-lg hover:bg-blue-600 font-medium">
                                        <i class="fas fa-phone-alt mr-2"></i>Contact
                                    </button>
                                </form>
                                <?php endif; ?>
                                
                                <!-- Delete Booking Form (only for completed or cancelled) -->
                                <?php if ($booking['status'] == 'completed' || $booking['status'] == 'cancelled'): ?>
                                    <form action="Proccessing_pages/Booking/delete-booking.php" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this booking? This action cannot be undone.');">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <button type="submit"
                                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                                            <i class="fas fa-trash mr-2"></i>Delete
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Provider & Problem Info -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Provider Info -->
                            <div class="bg-gray-50 rounded-xl p-4">
                                <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-tools mr-2 text-fixo-blue"></i> Service Provider
                                </h4>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-fixo-blue flex items-center justify-center text-white font-bold mr-3">
                                            <?php echo strtoupper(substr($booking['provider_name'] ?? 'N', 0, 1)); ?>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900"><?php echo htmlspecialchars($booking['provider_name'] ?? 'Not assigned yet'); ?></p>
                                            <?php if (isset($booking['provider_rating'])): ?>
                                            <div class="flex items-center mt-1">
                                                <div class="text-yellow-400">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <?php if($i <= $booking['provider_rating']): ?>
                                                            <i class="fas fa-star"></i>
                                                        <?php else: ?>
                                                            <i class="far fa-star"></i>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="ml-2 text-sm text-gray-600"><?php echo $booking['provider_rating']; ?>/5</span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if (!empty($booking['service'])): ?>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Service</p>
                                        <p class="font-medium text-sm"><?php echo htmlspecialchars($booking['service']); ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Rating Form (only for completed bookings) -->
                                <?php if ($booking['status'] == 'completed' && !empty($booking['provider_id'])): ?>
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <h5 class="font-medium text-gray-700 mb-2">Rate this service:</h5>
                                    <form action="Proccessing_pages/Booking/submit-rating.php" method="POST" id="ratingForm<?php echo $booking['id']; ?>" class="rating-form">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <input type="hidden" name="provider_id" value="<?php echo $booking['provider_id']; ?>">
                                        <input type="hidden" name="rating" id="ratingValue<?php echo $booking['id']; ?>" value="">
                                        <div class="rating-stars flex space-x-1" data-booking-id="<?php echo $booking['id']; ?>">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <button type="button" class="star-btn focus:outline-none" data-value="<?php echo $i; ?>">
                                                    <i class="far fa-star text-yellow-400 text-xl hover:text-yellow-500 transition-colors"></i>
                                                </button>
                                            <?php endfor; ?>
                                        </div>
                                        <button type="submit" class="mt-2 px-3 py-1 bg-fixo-orange text-white rounded text-sm hidden" id="submitRating<?php echo $booking['id']; ?>">
                                            Submit Rating
                                        </button>
                                    </form>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Problem Details -->
                            <div class="bg-gray-50 rounded-xl p-4 lg:col-span-2">
                                <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2 text-fixo-blue"></i> Service Details
                                </h4>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Problem Type</p>
                                        <p class="font-medium text-lg"><?php echo htmlspecialchars(ucwords($booking['problem_type'])); ?></p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Description</p>
                                        <p class="font-medium"><?php echo htmlspecialchars($booking['problem_description']); ?></p>
                                    </div>
                                    <div class="pt-3 border-t border-gray-200">
                                        <p class="text-sm text-gray-500 mb-1">Last Updated</p>
                                        <p class="font-medium">
                                            <i class="far fa-clock mr-2"></i>
                                            <?php echo htmlspecialchars($booking['updated_at_formatted']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-history mr-2 text-fixo-blue"></i> Booking Timeline
                            </h4>
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white">
                                        <i class="fas fa-check text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">Booked</p>
                                        <p class="text-sm text-gray-500">
                                            <?php echo date('M d, h:i A', strtotime($booking['created_at'])); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex-1 border-t-2 border-dashed <?php echo $booking['timeline']['confirmed'] ? 'border-blue-500' : 'border-gray-300'; ?>"></div>

                                <div class="flex-1 flex items-center">
                                    <div class="w-8 h-8 rounded-full 
                                    <?php echo $booking['timeline']['confirmed'] ? 'bg-blue-500' : 'bg-gray-300'; ?> 
                                    flex items-center justify-center text-white">
                                        <i class="fas 
                                        <?php echo $booking['timeline']['confirmed'] ? 'fa-check' : 'fa-clock'; ?> 
                                        text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">Confirmed</p>
                                        <p class="text-sm text-gray-500">
                                            <?php echo $booking['timeline']['confirmed'] ? 'Provider accepted' : 'Awaiting confirmation'; ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex-1 border-t-2 border-dashed <?php echo $booking['timeline']['service'] ? 'border-blue-500' : 'border-gray-300'; ?>"></div>

                                <div class="flex-1 flex items-center">
                                    <div class="w-8 h-8 rounded-full 
                                    <?php
                                    if ($booking['timeline']['service'])
                                        echo 'bg-blue-500';
                                    elseif ($booking['timeline']['confirmed'])
                                        echo 'bg-gray-300';
                                    else
                                        echo 'bg-gray-200';
                                    ?> 
                                    flex items-center justify-center text-white">
                                        <i class="fas 
                                        <?php
                                        if ($booking['timeline']['service'])
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

                                <div class="flex-1 border-t-2 border-dashed <?php echo $booking['timeline']['completed'] ? 'border-green-500' : 'border-gray-300'; ?>"></div>

                                <div class="flex-1 flex items-center">
                                    <div class="w-8 h-8 rounded-full 
                                    <?php echo $booking['timeline']['completed'] ? 'bg-green-500' : 'bg-gray-200'; ?> 
                                    flex items-center justify-center text-white">
                                        <i class="fas 
                                        <?php echo $booking['timeline']['completed'] ? 'fa-check-double' : 'fa-flag-checkered'; ?> 
                                        text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">Completed</p>
                                        <p class="text-sm text-gray-500">
                                            <?php echo $booking['timeline']['completed'] ? 'Job completed' : 'Pending completion'; ?>
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
            const provider = card.getAttribute('data-provider');
            const problem = card.getAttribute('data-problem');
            const description = card.getAttribute('data-description');

            // Apply status filter
            const statusMatches = currentFilter === 'all' || status === currentFilter;

            // Apply search filter
            const searchMatches = currentSearchTerm === '' ||
                provider.includes(currentSearchTerm) ||
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
                tab.classList.add('border-b-2', 'border-fixo-blue', 'text-fixo-blue');
                tab.classList.remove('text-gray-600');
            } else {
                tab.classList.remove('border-b-2', 'border-fixo-blue', 'text-fixo-blue');
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

    // Initialize star rating functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Add star rating functionality for each rating form
        document.querySelectorAll('.rating-form').forEach(form => {
            const bookingId = form.id.replace('ratingForm', '');
            const starsContainer = document.querySelector(`.rating-stars[data-booking-id="${bookingId}"]`);
            
            if (starsContainer) {
                const stars = starsContainer.querySelectorAll('.star-btn');
                const ratingInput = document.getElementById(`ratingValue${bookingId}`);
                const submitBtn = document.getElementById(`submitRating${bookingId}`);
                
                stars.forEach(star => {
                    star.addEventListener('mouseenter', function() {
                        const value = parseInt(this.getAttribute('data-value'));
                        highlightStars(stars, value);
                    });
                    
                    star.addEventListener('click', function() {
                        const value = parseInt(this.getAttribute('data-value'));
                        ratingInput.value = value;
                        if (submitBtn) {
                            submitBtn.classList.remove('hidden');
                        }
                        highlightStars(stars, value);
                    });
                });
                
                starsContainer.addEventListener('mouseleave', function() {
                    const currentValue = ratingInput.value ? parseInt(ratingInput.value) : 0;
                    highlightStars(stars, currentValue);
                });
                
                function highlightStars(starsArray, count) {
                    starsArray.forEach((star, index) => {
                        const icon = star.querySelector('i');
                        if (index < count) {
                            icon.classList.remove('far');
                            icon.classList.add('fas', 'text-yellow-500');
                        } else {
                            icon.classList.remove('fas', 'text-yellow-500');
                            icon.classList.add('far', 'text-yellow-400');
                        }
                    });
                }
            }
        });
    });

    // Close modal on ESC key press
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('contactModal');
            if (modal) {
                modal.remove();
            }
        }
    });

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('contactModal');
        if (modal && e.target === modal) {
            modal.remove();
        }
    });

    // Initialize
    filterBookings();
</script>