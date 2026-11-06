<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeEstate Living | Luxury Real Estate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F7F5EF] text-gray-800 font-sans antialiased min-h-screen flex flex-col">
    
    <!-- Navbar Include -->
    @include('layouts.navigation')

    <!-- Hero Section -->
    <div class="relative bg-[#173F35] text-[#F7F5EF] py-16 sm:py-24 md:py-28 text-center overflow-hidden">
        <div class="absolute inset-0 opacity-25 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1920&q=80')"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-[#C5A46D] uppercase tracking-widest text-xs sm:text-sm font-semibold">Exquisite Properties & Estates</span>
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-serif font-bold mt-3 mb-4 sm:mb-6 leading-tight">
                Discover Your Extraordinary Sanctuary
            </h1>
            <p class="text-sm sm:text-base md:text-lg text-gray-200 max-w-2xl mx-auto mb-8 sm:mb-10 leading-relaxed">
                Explore our exclusive portfolio of luxury homes, modern penthouses, and architectural masterpieces tailored for refined living.
            </p>
            
            <!-- Quick Search Bar (Responsive Grid) -->
            <form action="{{ route('properties') }}" method="GET" class="bg-white p-4 sm:p-5 rounded-lg shadow-2xl max-w-3xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 text-gray-800 text-left">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Location / Title</label>
                    <input type="text" name="search" placeholder="Enter keyword..." class="w-full border-gray-300 rounded-md text-sm p-2 focus:border-[#173F35] focus:ring-[#173F35]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Category</label>
                    <select name="category" class="w-full border-gray-300 rounded-md text-sm p-2 focus:border-[#173F35] focus:ring-[#173F35]">
                        <option value="">All Categories</option>
                        @if(isset($categories))
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Min Bedrooms</label>
                    <input type="number" name="bedrooms" placeholder="Any" class="w-full border-gray-300 rounded-md text-sm p-2 focus:border-[#173F35] focus:ring-[#173F35]">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-[#173F35] text-[#C5A46D] font-semibold py-2.5 rounded-md hover:bg-[#102b24] transition text-sm uppercase tracking-wider shadow">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Featured Properties Section -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 w-full">
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-[#C5A46D] uppercase tracking-widest text-xs font-bold">Handpicked Selection</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-serif font-bold text-[#173F35] mt-2">Featured Luxury Listings</h2>
        </div>

        @if(isset($featuredProperties) && $featuredProperties->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($featuredProperties as $property)
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
                        <span class="absolute top-3 left-3 sm:top-4 sm:left-4 bg-[#173F35] text-[#C5A46D] text-xs font-bold px-3 py-1 rounded-sm shadow">Featured</span>
                        <span class="absolute bottom-3 right-3 sm:bottom-4 sm:right-4 bg-[#C5A46D] text-[#173F35] font-serif font-bold text-base sm:text-lg px-3 sm:px-4 py-1 rounded-sm shadow">
                            ${{ number_format($property->price, 0) }}
                        </span>
                    </div>
                    
                    <div class="p-5 sm:p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-400 uppercase tracking-wider mb-1 font-semibold">{{ $property->category->name ?? 'Luxury Estate' }}</span>
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
        @else
            <p class="text-center text-gray-500 text-sm">No featured properties available at the moment.</p>
        @endif
    </main>

</body>
</html>