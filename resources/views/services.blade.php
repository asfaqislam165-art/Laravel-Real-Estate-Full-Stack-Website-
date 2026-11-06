@extends('layouts.app')

@section('content')
<div class="bg-[#F7F5EF] min-h-screen py-10 sm:py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">

        <!-- Header Section -->
        <div class="text-center mb-10 sm:mb-14">
            <span class="bg-[#173F35] text-[#C5A46D] px-4 py-1.5 rounded-sm text-xs uppercase font-bold tracking-widest inline-block">
                Our Expertise
            </span>
            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl text-[#173F35] mt-3 mb-3 font-bold">
                Exclusive Real Estate Services
            </h1>
            <p class="text-gray-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                We provide world-class, bespoke property solutions tailored for elite investors, buyers, and high-net-worth individuals.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mb-12 sm:mb-16">
            
            <!-- Service 1 -->
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-sm hover:shadow-md transition duration-300 border-t-4 border-[#173F35] flex flex-col">
                <div class="text-3xl sm:text-4xl mb-4">🏛️</div>
                <h3 class="font-serif text-lg sm:text-xl text-[#173F35] mb-2 font-bold">Luxury Property Acquisition</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Discreet and personalized assistance in finding and acquiring the most prestigious penthouses, villas, and historical estates across prime locations.
                </p>
            </div>

            <!-- Service 2 -->
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-sm hover:shadow-md transition duration-300 border-t-4 border-[#C5A46D] flex flex-col">
                <div class="text-3xl sm:text-4xl mb-4">🔑</div>
                <h3 class="font-serif text-lg sm:text-xl text-[#173F35] mb-2 font-bold">Private VIP Tours</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Experience private, chauffeur-driven or escorted viewings of luxury properties with senior real estate consultants at your absolute convenience.
                </p>
            </div>

            <!-- Service 3 -->
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-sm hover:shadow-md transition duration-300 border-t-4 border-[#173F35] flex flex-col">
                <div class="text-3xl sm:text-4xl mb-4">📈</div>
                <h3 class="font-serif text-lg sm:text-xl text-[#173F35] mb-2 font-bold">Portfolio & Asset Management</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Strategic guidance on property portfolio diversification, high-yield luxury rental management, and long-term capital appreciation planning.
                </p>
            </div>

            <!-- Service 4 -->
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-sm hover:shadow-md transition duration-300 border-t-4 border-[#C5A46D] flex flex-col">
                <div class="text-3xl sm:text-4xl mb-4">⚖️</div>
                <h3 class="font-serif text-lg sm:text-xl text-[#173F35] mb-2 font-bold">Legal & Financial Advisory</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Comprehensive legal structuring, title verification, secure escrow coordination, and tax-efficient transaction support with top legal experts.
                </p>
            </div>

        </div>

        <!-- Call to Action Banner -->
        <div class="bg-[#173F35] p-8 sm:p-12 rounded-lg text-center text-white shadow-lg border-t-4 border-[#C5A46D]">
            <h2 class="font-serif text-2xl sm:text-3xl text-[#C5A46D] mb-3 font-bold">Ready to Elevate Your Real Estate Journey?</h2>
            <p class="text-gray-200 text-sm sm:text-base mb-6 max-w-xl mx-auto leading-relaxed">
                Connect with our senior consultants today to discuss your unique requirements and custom property requests.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-[#C5A46D] text-[#173F35] px-8 py-3.5 rounded-md font-bold text-xs sm:text-sm uppercase tracking-widest hover:bg-[#b3925c] transition shadow">
                Schedule a Consultation
            </a>
        </div>

    </div>
</div>
@endsection