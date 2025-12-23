<?php
require_once __DIR__ . "/../../Proccessing_pages/Dashboard/dashboard-provider-proccessing.php";


// Get user data from session
$user_data = $_SESSION["user"] ?? [];

if (empty($user_data)) {
    echo "<div class='p-4 bg-red-100 text-red-700 rounded'>Error: No user data</div>";
    return;
}



// Simulate dashboard data (replace with actual DB queries)
$dashboard_stats = [
    'total_jobs' => 147,
    'pending_jobs' => 5,
    'completed_today' => 3,
    'total_earnings' => 12540,
    'avg_rating' => $user_data['rating'] ?? 4.9,
    'response_rate' => 98
];


// $recent_bookings = [
//     ['id' => 1001, 'customer' => 'John Smith', 'problem_type' => 'Oil Change', 'created_at' => '10:30 AM', 'status' => 'pending'],
//     ['id' => 1002, 'customer' => 'Sarah Johnson', 'problem_type' => 'Brake Repair', 'created_at' => '2:00 PM', 'status' => 'confirmed'],
//     ['id' => 1003, 'customer' => 'Mike Chen', 'problem_type' => 'AC Repair', 'created_at' => '4:30 PM', 'status' => 'completed']
// ];

$earnings_data = [
    'this_week' => 3200,
    'last_week' => 2800,
    'this_month' => 12540
];
?>

<!-- Provider Dashboard -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome back, <?php echo htmlspecialchars($user_data['name']); ?>! Here's your
            overview.</p>

        <!-- Availability Toggle -->
        <div class="mt-4 flex items-center space-x-4">
            <form action="Proccessing_pages/Dashboard/provider-availibility.php" method="POST">
                <span class="text-gray-700">Availability:</span>
                <div class="relative inline-block w-12 mr-2 align-middle select-none">
                    <input type="checkbox" name="availability" id="availability-toggle"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                        onchange="this.form.submit()" <?php echo ($user_data['availability'] == "available") ? 'checked' : ''; ?>>
                    <label for="availability-toggle"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
                <span id="availability-status"
                    class="font-medium <?php echo ($user_data['availability'] == "available") ? 'text-green-600' : 'text-red-600'; ?>">
                    <?php echo ($user_data['availability'] == "available") ? 'Available' : 'Not Available'; ?>
                </span>
            </form>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Jobs -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-fixo-orange">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-wrench text-fixo-orange text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Jobs</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $dashboard_stats['total_jobs']; ?></p>
                </div>
            </div>
        </div>

        <!-- Pending Jobs -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Pending</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $dashboard_stats['pending_jobs']; ?></p>
                </div>
            </div>
        </div>

        <!-- Earnings -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Earnings</p>
                    <p class="text-3xl font-bold text-gray-800">
                        $<?php echo number_format($dashboard_stats['total_earnings']); ?></p>
                </div>
            </div>
        </div>

        <!-- Rating -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-star text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Avg. Rating</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $dashboard_stats['avg_rating']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Recent Bookings -->
        <div class="lg:col-span-2">
            <!-- Recent Bookings -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Recent Bookings</h2>
                    <a href="bookings.php" class="text-fixo-orange hover:text-orange-600 font-medium text-sm">
                        View all <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="space-y-4">
                    <?php foreach ($recent_bookings as $booking): ?>
                        <div
                            class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mr-4">
                                    <i class="fas fa-car text-gray-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900"><?php echo $booking['customer']; ?></p>
                                    <p class="text-sm text-gray-500">
                                        <?php echo ucwords($booking['problem_type']); ?> •
                                        <?php echo (new DateTime($booking['created_at']))->format('M d, Y'); ?> •
                                        <?php echo (new DateTime($booking['created_at']))->format('h:i A'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="px-3 py-1 rounded-full text-xs font-medium 
                                <?php
                                if ($booking['status'] == 'completed')
                                    echo 'bg-green-100 text-green-800';
                                elseif ($booking['status'] == 'confirmed')
                                    echo 'bg-blue-100 text-blue-800';
                                else
                                    echo 'bg-yellow-100 text-yellow-800';
                                ?>">
                                    <?php echo ucfirst($booking['status']); ?>
                                </span>
                                <button class="ml-3 text-gray-400 hover:text-fixo-orange">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Quick Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="font-medium text-gray-700 mb-4">Quick Actions</h3>
                    <div class="flex space-x-4">
                        <button
                            class="flex-1 bg-fixo-orange text-white py-3 rounded-xl hover:bg-orange-600 font-medium">
                            <i class="fas fa-plus mr-2"></i> New Service
                        </button>
                        <button
                            class="flex-1 bg-white border border-gray-300 text-gray-700 py-3 rounded-xl hover:bg-gray-50 font-medium">
                            <i class="fas fa-calendar-alt mr-2"></i> Schedule
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar -->
        <div class="space-y-8">
            <!-- Earnings Summary -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Earnings Summary</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-week text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">This Week</p>
                                <p class="font-bold">$<?php echo number_format($earnings_data['this_week']); ?></p>
                            </div>
                        </div>
                        <span class="text-green-600 text-sm font-medium">+14%</span>
                    </div>

                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">This Month</p>
                                <p class="font-bold">$<?php echo number_format($earnings_data['this_month']); ?></p>
                            </div>
                        </div>
                    </div>

                    <button class="w-full mt-4 bg-gray-100 text-gray-700 py-3 rounded-xl hover:bg-gray-200 font-medium">
                        <i class="fas fa-chart-line mr-2"></i> View Detailed Report
                    </button>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Today's Schedule</h2>
                <div class="space-y-4">
                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <span class="font-bold text-fixo-orange">10:30</span>
                        </div>
                        <div>
                            <p class="font-medium">Oil Change</p>
                            <p class="text-sm text-gray-500">John Smith • Toyota Camry</p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <span class="font-bold text-blue-600">14:00</span>
                        </div>
                        <div>
                            <p class="font-medium">Brake Repair</p>
                            <p class="text-sm text-gray-500">Sarah Johnson • Honda Civic</p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <span class="font-bold text-green-600">16:30</span>
                        </div>
                        <div>
                            <p class="font-medium">AC Repair</p>
                            <p class="text-sm text-gray-500">Mike Chen • Ford Focus</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Performance</h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-600">Response Rate</span>
                            <span class="text-sm font-bold"><?php echo $dashboard_stats['response_rate']; ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full"
                                style="width: <?php echo $dashboard_stats['response_rate']; ?>%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-600">Completion Rate</span>
                            <span class="text-sm font-bold">95%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 95%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-600">Customer Satisfaction</span>
                            <span class="text-sm font-bold">4.8/5</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-fixo-orange h-2 rounded-full" style="width: 96%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Toggle Switch Styling */
    .toggle-checkbox:checked {
        right: 0;
        border-color: #f97316;
    }

    .toggle-checkbox:checked+.toggle-label {
        background-color: #f97316;
    }

    .toggle-checkbox {
        transition: all 0.3s;
    }
</style>

<script>
    // Availability Toggle
    const toggle = document.getElementById('availability-toggle');
    const statusText = document.getElementById('availability-status');

    if (toggle) {
        toggle.addEventListener('change', function () {
            if (this.checked) {
                statusText.textContent = 'Available';
                statusText.className = 'font-medium text-green-600';
                // Here you would make an AJAX call to update availability in database
                console.log('Setting availability to: Available');
            } else {
                statusText.textContent = 'Not Available';
                statusText.className = 'font-medium text-red-600';
                // Here you would make an AJAX call to update availability in database
                console.log('Setting availability to: Not Available');
            }
        });
    }

    // Quick action buttons
    document.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', function (e) {
            if (this.textContent.includes('New Service') ||
                this.textContent.includes('Schedule') ||
                this.textContent.includes('View Detailed Report')) {
                e.preventDefault();
                alert('This feature would be implemented next. Add your functionality here.');
            }
        });
    });
</script>