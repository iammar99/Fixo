<?php
$pageTitle = "Home";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'fixo-orange': '#f97316',
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                        'float': 'float 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    <style>
        /* Add missing animations */
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .grid-pattern {
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
    <title>Fixo - Mobile Mechanics On-Demand</title>
</head>

<body class="bg-white text-gray-900">

    <!-- Your Header -->
    <?php require_once "./includes/components/header.php"; ?>

    <!-- Your Original Hero Section -->
    <section class="relative overflow-hidden">
        <!-- Background Elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-orange-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="relative">
                    <div class="mb-6">
                        <div
                            class="inline-flex items-center px-4 py-2 bg-orange-100 text-fixo-orange rounded-full text-sm font-medium mb-4">
                            <span class="w-2 h-2 bg-fixo-orange rounded-full mr-2"></span>
                            Mobile Mechanic Service
                        </div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                            Mobile Mechanics,
                            <span class="text-fixo-orange">Wherever</span>
                            You Are
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 max-w-2xl">
                            Get professional vehicle repair at your location. Certified mechanics come to you with tools
                            and expertise.
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/dashboard.php"
                            class="px-8 py-4 bg-fixo-orange text-white font-bold rounded-xl hover:bg-orange-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-flex items-center justify-center">
                            Book a Mechanic
                            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </a>

                        <a href="/registeration.php?type=provider"
                            class="px-8 py-4 bg-white text-gray-900 font-bold rounded-xl hover:bg-gray-50 transition-all duration-300 border-2 border-gray-300 hover:border-fixo-orange inline-flex items-center justify-center">
                            Become a Mechanic
                            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="mt-12 grid grid-cols-3 gap-6">
                        <div>
                            <div class="text-2xl font-bold text-gray-900">45<span class="text-fixo-orange">min</span>
                            </div>
                            <div class="text-sm text-gray-500">Avg. Response Time</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">98<span class="text-fixo-orange">%</span>
                            </div>
                            <div class="text-sm text-gray-500">Customer Satisfaction</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900">500<span class="text-fixo-orange">+</span>
                            </div>
                            <div class="text-sm text-gray-500">Certified Mechanics</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Visual -->
                <div class="relative">
                    <div
                        class="relative bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-8 md:p-12 shadow-2xl">
                        <div class="grid grid-cols-2 gap-6">
                            <!-- Visual Elements -->
                            <div
                                class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 transform rotate-3 animate-float">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-white font-bold mt-4">Roadside Assistance</div>
                            </div>
                            <div
                                class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 transform -rotate-3 animate-float animation-delay-2000">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                                <div class="text-white font-bold mt-4">Mobile Workshop</div>
                            </div>
                            <div
                                class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 col-span-2 transform animate-float animation-delay-1000">
                                <svg class="w-12 h-12 text-white mx-auto" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                <div class="text-white font-bold mt-4 text-center">Verified Mechanics</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section - Fixed for Mobile -->
    <section class="py-16 md:py-24 bg-gray-50" id="howItWorks">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">How Fixo Works</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Three simple steps to get your vehicle fixed on-site
                </p>
            </div>

            <!-- Mobile First Layout - Stacked on mobile, timeline on desktop -->
            <div class="space-y-12 md:space-y-0 md:relative">
                <!-- Desktop Timeline Line -->
                <div
                    class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-fixo-orange to-blue-500">
                </div>

                <!-- Step 1 -->
                <div class="md:flex md:items-center">
                    <!-- Left Side (Mobile: Top, Desktop: Left) -->
                    <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0">
                        <div
                            class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 transform hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <!-- Mobile Step Icon (Visible only on mobile) -->
                                <div
                                    class="md:hidden w-14 h-14 bg-gradient-to-br from-fixo-orange to-orange-500 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                        </path>
                                    </svg>
                                </div>

                                <div>
                                    <div class="text-fixo-orange font-semibold text-sm uppercase tracking-wide">Step 1
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900">Tell Us Your Car Issue</h3>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6">Describe your vehicle problem with photos or select from
                                common issues</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-orange-100 text-fixo-orange rounded-full text-sm">Engine
                                    Trouble</span>
                                <span class="px-3 py-1 bg-orange-100 text-fixo-orange rounded-full text-sm">Flat
                                    Tire</span>
                                <span class="px-3 py-1 bg-orange-100 text-fixo-orange rounded-full text-sm">Battery
                                    Dead</span>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Center Icon (Hidden on mobile) -->
                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 z-10">
                        <div
                            class="w-16 h-16 bg-white rounded-2xl shadow-xl flex items-center justify-center border-4 border-white">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-fixo-orange to-orange-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side (Mobile: Hidden, Desktop: Right) -->
                    <div class="hidden md:block md:w-1/2 md:pl-12 md:text-right">
                        <div class="text-gray-600">
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Quick & Easy Reporting</h4>
                            <p>Upload photos, describe symptoms, and get instant mechanic matching</p>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="md:flex md:items-center md:flex-row-reverse">
                    <!-- Right Side (Mobile: Top, Desktop: Right) -->
                    <div class="md:w-1/2 md:pl-12 mb-8 md:mb-0">
                        <div
                            class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 transform hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <!-- Mobile Step Icon (Visible only on mobile) -->
                                <div
                                    class="md:hidden w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>

                                <div>
                                    <div class="text-blue-600 font-semibold text-sm uppercase tracking-wide">Step 2
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900">Mechanic Comes to You</h3>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6">Certified mobile mechanic arrives at your location with tools
                                and equipment</p>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700">Live tracking with real-time ETA</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700">Average arrival: 45 minutes</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Center Icon (Hidden on mobile) -->
                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 z-10 mt-32">
                        <div
                            class="w-16 h-16 bg-white rounded-2xl shadow-xl flex items-center justify-center border-4 border-white">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Left Side (Mobile: Hidden, Desktop: Left) -->
                    <div class="hidden md:block md:w-1/2 md:pr-12">
                        <div class="text-gray-600">
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Mobile Workshop Arrives</h4>
                            <p>Fully equipped vehicle with tools and common parts for on-site repairs</p>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="md:flex md:items-center">
                    <!-- Left Side (Mobile: Top, Desktop: Left) -->
                    <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0">
                        <div
                            class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 transform hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <!-- Mobile Step Icon (Visible only on mobile) -->
                                <div
                                    class="md:hidden w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>

                                <div>
                                    <div class="text-green-600 font-semibold text-sm uppercase tracking-wide">Step 3
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900">Repair Done On-Site</h3>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6">Professional repair completed at your location with quality
                                guarantee</p>
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-gray-700">Service Warranty</span>
                                    <span class="font-bold text-green-700">30 Days</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700">Payment</span>
                                    <span class="font-bold text-green-700">After Service</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Center Icon (Hidden on mobile) -->
                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 z-10 mt-64">
                        <div
                            class="w-16 h-16 bg-white rounded-2xl shadow-xl flex items-center justify-center border-4 border-white">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side (Mobile: Hidden, Desktop: Right) -->
                    <div class="hidden md:block md:w-1/2 md:pl-12 md:text-right">
                        <div class="text-gray-600">
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Quality Service Guaranteed</h4>
                            <p>All repairs come with 30-day warranty and transparent pricing</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section - Your Original Design -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Mobile Mechanic Services</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Professional vehicle repair services delivered to
                    your location</p>
            </div>

            <!-- Unique Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-fixo-orange to-orange-500 rounded-2xl transform group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div
                        class="relative bg-white rounded-2xl p-8 transform -translate-x-1 -translate-y-1 group-hover:-translate-y-2 transition-transform duration-300 border-2 border-gray-200">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-fixo-orange to-orange-500 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Emergency Roadside Repair</h3>
                        <p class="text-gray-600 mb-4">Breakdown assistance, towing coordination, and immediate repairs
                        </p>
                        <div class="text-fixo-orange font-medium">Starting from Rs.999</div>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl transform group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div
                        class="relative bg-white rounded-2xl p-8 transform -translate-x-1 -translate-y-1 group-hover:-translate-y-2 transition-transform duration-300 border-2 border-gray-200">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Battery Services</h3>
                        <p class="text-gray-600 mb-4">Jump start, battery replacement, and electrical system diagnostics
                        </p>
                        <div class="text-blue-600 font-medium">Starting from Rs.799</div>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl transform group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div
                        class="relative bg-white rounded-2xl p-8 transform -translate-x-1 -translate-y-1 group-hover:-translate-y-2 transition-transform duration-300 border-2 border-gray-200">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Tire Puncture Repair</h3>
                        <p class="text-gray-600 mb-4">On-site tire repair, replacement, and wheel alignment checks</p>
                        <div class="text-green-600 font-medium">Starting from Rs.499</div>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="group relative md:col-span-2 lg:col-span-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl transform group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div
                        class="relative bg-white rounded-2xl p-8 transform -translate-x-1 -translate-y-1 group-hover:-translate-y-2 transition-transform duration-300 border-2 border-gray-200">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Engine Diagnostics</h3>
                        <p class="text-gray-600 mb-4">Complete engine check, error code reading, and performance
                            analysis</p>
                        <div class="text-purple-600 font-medium">Starting from Rs.1299</div>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl transform group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div
                        class="relative bg-white rounded-2xl p-8 transform -translate-x-1 -translate-y-1 group-hover:-translate-y-2 transition-transform duration-300 border-2 border-gray-200">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Brake Service</h3>
                        <p class="text-gray-600 mb-4">Brake inspection, pad replacement, and fluid checks</p>
                        <div class="text-yellow-600 font-medium">Starting from Rs.1499</div>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl transform group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div
                        class="relative bg-white rounded-2xl p-8 transform -translate-x-1 -translate-y-1 group-hover:-translate-y-2 transition-transform duration-300 border-2 border-gray-200">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Oil Change Service</h3>
                        <p class="text-gray-600 mb-4">Mobile oil change with filter replacement and fluid top-up</p>
                        <div class="text-red-600 font-medium">Starting from Rs.899</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Fixo - Your Original Design -->
    <section class="py-16 md:py-24 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Why Choose Fixo</h2>
                    <p class="text-gray-300 text-lg mb-8">
                        Experience the future of vehicle repair with our mobile mechanic platform designed for
                        convenience and trust.
                    </p>

                    <div class="space-y-6">
                        <!-- Benefit 1 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-fixo-orange to-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Verified Mobile Mechanics</h3>
                                <p class="text-gray-400">All mechanics are background checked, certified, and rated by
                                    customers</p>
                            </div>
                        </div>

                        <!-- Benefit 2 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Fast Response Time</h3>
                                <p class="text-gray-400">Average 45-minute response time with real-time mechanic
                                    tracking</p>
                            </div>
                        </div>

                        <!-- Benefit 3 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Transparent Pricing</h3>
                                <p class="text-gray-400">No hidden fees. Get upfront quotes and pay only after service
                                    completion</p>
                            </div>
                        </div>

                        <!-- Benefit 4 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">On-Location Convenience</h3>
                                <p class="text-gray-400">Repairs at your home, office, or roadside. No need to visit a
                                    garage</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Visual -->
                <div class="relative">
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl p-8 border border-gray-700">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-gray-800 rounded-2xl p-6">
                                <div class="text-3xl font-bold text-fixo-orange mb-2">24/7</div>
                                <div class="text-gray-300">Emergency Service</div>
                            </div>
                            <div class="bg-gray-800 rounded-2xl p-6">
                                <div class="text-3xl font-bold text-blue-500 mb-2">30-Day</div>
                                <div class="text-gray-300">Service Warranty</div>
                            </div>
                            <div class="bg-gray-800 rounded-2xl p-6 col-span-2">
                                <div class="text-3xl font-bold text-green-500 mb-2">4.9★</div>
                                <div class="text-gray-300">Customer Rating</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Strong CTA - Your Original Design -->
    <section class="py-16 md:py-24 bg-gradient-to-br from-fixo-orange to-orange-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                Car trouble? Get a mechanic at your location in minutes.
            </h2>
            <p class="text-orange-100 text-lg mb-8 max-w-2xl mx-auto">
                Don't wait at a garage. Our certified mobile mechanics come to you with everything needed for
                professional repairs.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/dashboard.php"
                    class="px-8 py-4 bg-white text-fixo-orange font-bold rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 inline-flex items-center justify-center">
                    Book Now
                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </a>
                <a href="#"
                    class="px-8 py-4 bg-transparent text-white font-bold rounded-xl hover:bg-orange-700 transition-all duration-300 border-2 border-white inline-flex items-center justify-center">
                    Call Emergency: 1800-FIXO-NOW
                </a>
            </div>

            <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-2xl font-bold">45 min</div>
                    <div class=" text-sm">Avg. Response</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold">98 %</div>
                    <div class="text-sm">Satisfaction</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold">500 +</div>
                    <div class=" text-sm">Mechanics</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold">24 /7</div>
                    <div class="text-sm">Available</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once "./includes/components/footer.php"; ?>

    <script>
        // Simple check to confirm everything is working
        console.log('Fixo website loaded successfully!');
    </script>
</body>

</html>