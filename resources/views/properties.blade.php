<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties Portfolio | LuxeEstate Living</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F7F5EF] text-gray-800 font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Include -->
    @include('layouts.navigation')

    <!-- Header Banner -->
    <div class="bg-[#173F35] text-[#F7F5EF] py-12 sm:py-16 text-center px-4">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-serif font-bold mb-2">Exclusive Portfolio</h1>
        <p class="text-xs sm:text-sm text-gray-300 max-w-xl mx-auto">Discover our handpicked collection of luxury estates and residences.</p>
    </div>

    <!-- Filter & Search Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 w-full">
        <form action="{{ route('properties') }}" method="GET" class="bg-white p-4 sm:p-6 rounded-lg shadow-sm grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end border border-gray-100">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Search Keyword</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Title or location..." class="w-full border-gray-300 rounded-md text-sm p-2.5 focus:border-[#173F35] focus:ring-[#173F35]">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Category</label>
                <select name="category" class="w-full border-gray-300 rounded-md text-sm p-2.5 focus:border-[#173F35] focus:ring-[#173F35]">
                    <option value="">All Categories</option>
                    @if(isset($categories))
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Min Bedrooms</label>
                <input type="number" name="bedrooms" value="{{ request('bedrooms') }}" placeholder="Any" class="w-full border-gray-300 rounded-md text-sm p-2.5 focus:border-[#173F35] focus:ring-[#173F35]">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Max Price ($)</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Any" class="w-full border-gray-300 rounded-md text-sm p-2.5 focus:border-[#173F35] focus:ring-[#173F35]">
            </div>
            <div class="sm:col-span-2 lg:col-span-1">
                <button type="submit" class="w-full bg-[#173F35] text-[#C5A46D] font-semibold py-2.5 rounded-md hover:bg-[#102b24] transition text-sm uppercase tracking-wider shadow-sm">
                    Filter Properties
                </button>
            </div>
        </form>
    </div>

    <!-- Properties Grid -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 sm:pb-20 w-full">
        @if(!isset($properties) || $properties->isEmpty())
            <div class="bg-white p-8 sm:p-12 text-center rounded-lg shadow-sm border border-gray-100">
                <p class="text-gray-500 text-base sm:text-lg">No luxury properties found matching your criteria.</p>
                <a href="{{ route('properties') }}" class="mt-4 inline-block text-[#173F35] font-bold underline text-sm hover:text-[#C5A46D] transition">Reset Filters</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($properties as $property)
                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 flex flex-col">
                    <div class="relative h-56 sm:h-64 overflow-hidden bg-gray-100">
                        @php
                            $mainImg = $property->featured_image ?? $property->image ?? '';
                        @endphp
                        @if($mainImg)
                            <img src="{{ asset('uploads/'.$mainImg) }}" alt="{{ $property->title }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Image Available</div>
                        @endif
                        <span class="absolute bottom-3 right-3 sm:bottom-4 sm:right-4 bg-[#C5A46D] text-[#173F35] font-serif font-bold text-base sm:text-lg px-3 sm:px-4 py-1 rounded-sm shadow">
                            ${{ number_format($property->price, 0) }}
                        </span>
                    </div>

                    <div class="p-5 sm:p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-400 uppercase tracking-wider mb-1 font-semibold">{{ $property->category->name ?? 'Estate' }}</span>
                        <h3 class="font-serif font-bold text-lg sm:text-xl text-[#173F35] mb-2 line-clamp-1">{{ $property->title }}</h3>
                        <p class="text-gray-600 text-xs sm:text-sm mb-4 line-clamp-1">📍 {{ $property->location }}</p>
                        
                        <div class="border-t border-gray-100 pt-4 mt-auto flex justify-between text-xs text-gray-600 font-semibold">
                            <span>🛏️ {{ $property->bedrooms ?? 'N/A' }} Beds</span>
                            <span>🛁 {{ $property->bathrooms ?? 'N/A' }} Baths</span>
                            <span>📐 {{ $property->area ?? $property->area_sqft ?? 'N/A' }} sqft</span>
                        </div>

                        <a href="{{ route('property.detail', $property->id) }}" class="mt-5 block text-center bg-[#173F35] text-[#F7F5EF] py-2.5 rounded-md font-semibold text-xs sm:text-sm hover:bg-[#C5A46D] hover:text-[#173F35] transition">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-10 flex justify-center">
                {{ $properties->links() }}
            </div>
        @endif
    </main>

</body>
</html>