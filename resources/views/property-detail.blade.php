@extends('layouts.app')

@section('content')
<div class="bg-[#F7F5EF] min-h-screen py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Back Button / Breadcrumb -->
        <div>
            <a href="{{ route('properties') }}" class="text-[#173F35] text-xs sm:text-sm font-bold hover:underline inline-flex items-center gap-1">
                &larr; Back to Portfolio
            </a>
        </div>

        @if(session('status'))
            <div class="bg-[#173F35] text-[#C5A46D] p-4 rounded-lg font-bold text-center text-sm sm:text-base shadow-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- Property Main Header Card -->
        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-sm border-t-4 border-[#173F35]">
            <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6">
                <div>
                    <span class="bg-[#173F35] text-[#C5A46D] px-3 py-1 rounded-sm text-xs uppercase font-bold tracking-wider inline-block">
                        {{ $property->category->name ?? 'Luxury Estate' }}
                    </span>
                    <h1 class="font-serif text-2xl sm:text-3xl md:text-4xl text-[#173F35] mt-2 mb-1 font-bold">
                        {{ $property->title }}
                    </h1>
                    <p class="text-gray-500 text-xs sm:text-sm">📍 {{ $property->location }}</p>
                </div>
                <div class="text-left sm:text-right shrink-0">
                    <span class="text-2xl sm:text-3xl font-serif font-bold text-[#173F35] block">
                        ${{ number_format($property->price) }}
                    </span>
                    <span class="text-xs text-gray-400 uppercase tracking-wider">Listing Price</span>
                </div>
            </div>

            <!-- Main Featured Image -->
            @if($property->image)
                <div class="rounded-lg overflow-hidden mb-6 border border-gray-100 shadow-sm">
                    <img src="{{ asset('uploads/' . $property->image) }}" alt="{{ $property->title }}" class="w-full h-64 sm:h-96 md:h-[450px] object-cover block">
                </div>
            @endif

            <!-- Property Specs (Bedrooms, Bathrooms, Area) -->
            <div class="grid grid-cols-3 gap-3 sm:gap-4 bg-[#F7F5EF] p-4 sm:p-5 rounded-lg mb-6 border-l-4 border-[#C5A46D]">
                <div>
                    <span class="text-[10px] sm:text-xs text-gray-500 uppercase block font-bold">Bedrooms</span>
                    <span class="text-sm sm:text-lg font-bold text-[#173F35]">{{ $property->bedrooms ?? 'N/A' }} Beds</span>
                </div>
                <div>
                    <span class="text-[10px] sm:text-xs text-gray-500 uppercase block font-bold">Bathrooms</span>
                    <span class="text-sm sm:text-lg font-bold text-[#173F35]">{{ $property->bathrooms ?? 'N/A' }} Baths</span>
                </div>
                <div>
                    <span class="text-[10px] sm:text-xs text-gray-500 uppercase block font-bold">Area Size</span>
                    <span class="text-sm sm:text-lg font-bold text-[#173F35]">{{ $property->area ?? $property->area_sqft ?? 'N/A' }} sq ft</span>
                </div>
            </div>

            <!-- Property Description -->
            <div>
                <h3 class="font-serif text-lg sm:text-xl text-[#173F35] mb-2 font-bold">About This Property</h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                    {!! nl2br(e($property->description)) !!}
                </p>
            </div>
        </div>

        <!-- Property Gallery Images Section -->
        @if(isset($property->images) && $property->images->count() > 0)
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-sm border-t-4 border-[#173F35]">
                <h3 class="font-serif font-bold text-xl sm:text-2xl text-[#173F35] mb-4">Property Gallery</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($property->images as $img)
                        <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm bg-gray-50">
                            @php
                                $imgName = $img->image ?? $img->image_path ?? $img->filename ?? '';
                            @endphp
                            @if($imgName)
                                <img src="{{ asset('uploads/' . $imgName) }}" alt="Gallery Image" class="w-full h-40 sm:h-48 object-cover block hover:scale-105 transition duration-300">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Property Inquiry / Consultation Form -->
        <div class="bg-[#173F35] p-6 sm:p-10 rounded-lg text-white shadow-lg border-t-4 border-[#C5A46D]">
            <div class="max-w-2xl mx-auto">
                <h3 class="font-serif text-2xl sm:text-3xl text-[#C5A46D] mb-2 font-bold text-center">Inquire About This Property</h3>
                <p class="text-center text-gray-200 text-xs sm:text-sm mb-6">Fill out the form below to request a private viewing or direct details from our senior luxury consultant.</p>
                
                <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#C5A46D] uppercase mb-1">Your Name</label>
                            <input type="text" name="name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required 
                                class="w-full bg-white text-gray-800 border-0 rounded-md p-3 text-sm focus:ring-2 focus:ring-[#C5A46D]" placeholder="Full name">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#C5A46D] uppercase mb-1">Email Address</label>
                            <input type="email" name="email" value="{{ auth()->check() ? auth()->user()->email : '' }}" required 
                                class="w-full bg-white text-gray-800 border-0 rounded-md p-3 text-sm focus:ring-2 focus:ring-[#C5A46D]" placeholder="Email address">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#C5A46D] uppercase mb-1">Phone Number</label>
                        <input type="text" name="phone" required 
                            class="w-full bg-white text-gray-800 border-0 rounded-md p-3 text-sm focus:ring-2 focus:ring-[#C5A46D]" placeholder="Phone number">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#C5A46D] uppercase mb-1">Message / Custom Request</label>
                        <textarea name="message" rows="4" required 
                            class="w-full bg-white text-gray-800 border-0 rounded-md p-3 text-sm focus:ring-2 focus:ring-[#C5A46D]">I am interested in "{{ $property->title }}". Please contact me with further details.</textarea>
                    </div>

                    <div class="text-center pt-2">
                        <button type="submit" class="w-full sm:w-auto bg-[#C5A46D] text-[#173F35] px-8 py-3.5 rounded-md font-bold text-xs uppercase tracking-widest hover:bg-[#b3925c] transition shadow">
                            Submit Property Inquiry
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Client Reviews Section -->
        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-sm border-t-4 border-[#C5A46D]">
            <h3 class="font-serif font-bold text-xl sm:text-2xl text-[#173F35] mb-6">Client Reviews & Testimonials</h3>

            <!-- 1. Submit Review Form -->
            <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data" class="bg-[#F7F5EF] p-5 sm:p-6 rounded-lg border border-gray-200 mb-8 shadow-sm">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                
                <h4 class="font-serif font-bold text-lg text-[#173F35] mb-4">Leave a Review</h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Your Name</label>
                        <input type="text" name="client_name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required 
                            class="w-full bg-white text-gray-800 border border-gray-300 rounded-md p-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Rating (1 - 5)</label>
                        <select name="rating" required 
                            class="w-full bg-white text-gray-800 border border-gray-300 rounded-md p-2.5 text-sm">
                            <option value="5">5 - Exceptional Luxury</option>
                            <option value="4">4 - Very Good</option>
                            <option value="3">3 - Average</option>
                            <option value="2">2 - Below Expectations</option>
                            <option value="1">1 - Poor</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Your Role / Title (Optional)</label>
                        <input type="text" name="client_role" placeholder="e.g. Verified Investor" 
                            class="w-full bg-white text-gray-800 border border-gray-300 rounded-md p-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Profile Photo (Optional)</label>
                        <input type="file" name="client_image" 
                            class="w-full bg-white text-gray-600 border border-gray-300 rounded-md p-1.5 text-xs">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Comment</label>
                    <textarea name="comment" rows="3" required 
                        class="w-full bg-white text-gray-800 border border-gray-300 rounded-md p-2.5 text-sm" placeholder="Share your experience..."></textarea>
                </div>

                <button type="submit" class="w-full sm:w-auto bg-[#173F35] text-[#C5A46D] px-6 py-2.5 rounded-md font-bold text-xs uppercase tracking-wider hover:bg-[#102b24] transition">
                    Submit Review
                </button>
            </form>

            <!-- 2. Display Existing Published Reviews -->
            <h4 class="font-serif font-bold text-lg text-[#173F35] mb-4">User Reviews</h4>
            @if(isset($property->reviews) && $property->reviews->count() > 0)
                <div class="space-y-4">
                    @foreach($property->reviews as $review)
                        @if($review->is_published)
                            <div class="p-4 bg-[#F7F5EF] rounded-lg border-l-4 border-[#173F35] shadow-sm">
                                <div class="flex justify-between items-center mb-2">
                                    <h5 class="font-bold text-sm text-[#173F35]">{{ $review->client_name }}</h5>
                                    <span class="text-xs text-[#C5A46D] font-bold">★ {{ $review->rating }} / 5</span>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed mb-2">{{ $review->comment }}</p>
                                @if($review->client_role)
                                    <span class="text-[11px] text-gray-400 block">— {{ $review->client_role }}</span>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-sm italic">No reviews yet for this property. Be the first to share your experience!</p>
            @endif

        </div>

    </div>
</div>
@endsection