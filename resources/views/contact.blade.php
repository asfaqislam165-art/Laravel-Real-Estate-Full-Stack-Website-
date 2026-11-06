<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | LuxeEstate Living</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F7F5EF] text-gray-800 font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Include -->
    @include('layouts.navigation')

    <!-- Main Content Container -->
    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        <div class="max-w-4xl w-full bg-white rounded-lg shadow-sm p-6 sm:p-10 border-t-4 border-[#C5A46D]">
            
            <!-- Section Header -->
            <span class="text-xs uppercase tracking-widest text-[#C5A46D] font-bold">Get In Touch</span>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-serif font-bold mb-6 text-[#173F35] mt-2">
                Contact Our Executive Office
            </h1>
            
            <!-- Contact Details Grid / List -->
            <div class="space-y-3 sm:space-y-2 text-gray-700 text-sm sm:text-base mb-8 bg-[#F7F5EF]/50 p-4 sm:p-6 rounded-lg border border-gray-100">
                <p class="break-words"><strong class="text-gray-900">Headquarters Address:</strong> {{ $setting->address ?? '450 Park Avenue, Suite 1200, New York, NY' }}</p>
                <p class="break-words"><strong class="text-gray-900">VIP Hotline:</strong> {{ $setting->contact_phone ?? '+1 (800) 555-LUXE' }}</p>
                <p class="break-words"><strong class="text-gray-900">Email Contact:</strong> {{ $setting->contact_email ?? 'support@luxeestate.com' }}</p>
                <p><strong class="text-gray-900">Working Hours:</strong> Monday – Saturday: 9:00 AM – 7:00 PM</p>
            </div>
            
            <!-- Session Status Message -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-md text-sm font-medium">
                    {{ session('status') }}
                </div>
            @endif
            
            <!-- Responsive Inquiry Form -->
            <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-4 sm:space-y-5 bg-[#F7F5EF] p-4 sm:p-6 rounded-lg border border-gray-200">
                @csrf
                <h3 class="font-serif font-bold text-lg text-[#173F35] mb-2">Send Us a Direct Message</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Your Name</label>
                        <input type="text" name="name" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm text-sm focus:border-[#173F35] focus:ring-[#173F35] p-2.5 bg-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email Address</label>
                        <input type="email" name="email" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm text-sm focus:border-[#173F35] focus:ring-[#173F35] p-2.5 bg-white">
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Phone Number</label>
                    <input type="text" name="phone" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm text-sm focus:border-[#173F35] focus:ring-[#173F35] p-2.5 bg-white">
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Message</label>
                    <textarea name="message" rows="4" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm text-sm focus:border-[#173F35] focus:ring-[#173F35] p-2.5 bg-white" placeholder="How can we assist you with your luxury property needs?"></textarea>
                </div>
                
                <div>
                    <button type="submit" class="w-full sm:w-auto bg-[#173F35] text-[#C5A46D] px-6 py-3 rounded-md font-semibold text-xs sm:text-sm uppercase tracking-wider hover:bg-[#102b24] transition shadow-sm">
                        Submit Message
                    </button>
                </div>
            </form>

        </div>
    </main>

</body>
</html>