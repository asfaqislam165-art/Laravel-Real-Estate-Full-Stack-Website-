<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | LuxeEstate Living</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F7F5EF] text-gray-800 font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Include -->
    @include('layouts.navigation')

    <!-- Main Content Container -->
    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        <div class="max-w-4xl w-full bg-white rounded-lg shadow-sm p-6 sm:p-10 border-t-4 border-[#C5A46D]">
            
            <!-- Section Header -->
            <span class="text-xs uppercase tracking-widest text-[#C5A46D] font-bold">Our Heritage</span>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-serif font-bold mb-4 text-[#173F35] mt-2">
                About LuxeEstate Living
            </h1>
            
            <!-- Descriptive Paragraphs -->
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">
                LuxeEstate Living is dedicated to providing high-end, luxury real estate services. Our mission is to connect discerning clients with architectural masterpieces, elite penthouses, and premier properties tailored for refined living.
            </p>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-8">
                Equipped with an exclusive portfolio and a team of professional luxury consultants, we ensure a seamless, confidential, and prestigious acquisition process for every client.
            </p>
            
            <!-- Responsive Statistics Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 pt-6 border-t border-gray-100 text-center">
                <div class="p-4 bg-[#F7F5EF] rounded-md transition hover:shadow-sm">
                    <p class="text-2xl sm:text-3xl font-serif font-bold text-[#173F35]">15+</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wide mt-1">Years Experience</p>
                </div>
                <div class="p-4 bg-[#F7F5EF] rounded-md transition hover:shadow-sm">
                    <p class="text-2xl sm:text-3xl font-serif font-bold text-[#173F35]">$500M+</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wide mt-1">Properties Sold</p>
                </div>
                <div class="p-4 bg-[#F7F5EF] rounded-md transition hover:shadow-sm">
                    <p class="text-2xl sm:text-3xl font-serif font-bold text-[#173F35]">100%</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wide mt-1">Client Satisfaction</p>
                </div>
            </div>

        </div>
    </main>

</body>
</html>