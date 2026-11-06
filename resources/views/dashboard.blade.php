<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-xl sm:text-2xl text-[#173F35] leading-tight">My Inquiries & Dashboard</h2>
    </x-slot>
    
    <div class="py-8 sm:py-12 bg-[#F7F5EF] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">
            
            <!-- Submitted Inquiries Section -->
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border-t-4 border-[#173F35]">
                <h3 class="text-lg sm:text-xl font-serif font-bold mb-4 text-[#173F35]">Your Submitted Inquiries</h3>
                
                @if(!isset($inquiries) || $inquiries->isEmpty())
                    <p class="text-gray-600 text-sm">You haven't submitted any inquiries yet. <a href="{{ route('properties') }}" class="text-[#173F35] font-bold underline">Explore properties</a>.</p>
                @else
                    <!-- Desktop / Tablet Table View -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-[#173F35] text-[#F7F5EF]">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">Property</th>
                                    <th class="px-4 py-3 text-left font-semibold">Message</th>
                                    <th class="px-4 py-3 text-left font-semibold">Date</th>
                                    <th class="px-4 py-3 text-left font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($inquiries as $item)
                                <tr>
                                    <td class="px-4 py-3 font-semibold text-[#173F35]">{{ $item->property->title ?? 'General Inquiry' }}</td>
                                    <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $item->message }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $item->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                            @if($item->status == 'Closed')   
                                            @elseif($item->status == 'Contacted')
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            {{ $item->status ?? 'Pending' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Responsive Card View -->
                    <div class="md:hidden space-y-4">
                        @foreach($inquiries as $item)
                        <div class="bg-[#F7F5EF] p-4 rounded-lg border border-gray-200 shadow-sm space-y-2">
                            <div class="flex justify-between items-start gap-2">
                                <h4 class="font-bold text-[#173F35] text-sm sm:text-base">{{ $item->property->title ?? 'General Inquiry' }}</h4>
                                <span class="px-2 py-0.5 text-xs font-semibold rounded-full shrink-0
                                    @if($item->status == 'Closed') 
                                    @elseif($item->status == 'Contacted')
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ $item->status ?? 'Pending' }}
                                </span>
                            </div>
                            <p class="text-gray-600 text-xs sm:text-sm italic">"{{ $item->message }}"</p>
                            <div class="text-right text-xs text-gray-400 pt-1 border-t border-gray-200">
                                {{ $item->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Submitted Reviews Section -->
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm border-t-4 border-[#C5A46D]">
                <h3 class="text-lg sm:text-xl font-serif font-bold mb-4 text-[#173F35]">Your Property Reviews</h3>

                @if(!isset($reviews) || $reviews->isEmpty())
                    <p class="text-gray-600 text-sm">You haven't submitted any reviews yet.</p>
                @else
                    <div class="space-y-4">
                        @foreach($reviews as $review)
                            <div class="p-4 bg-[#F7F5EF] rounded-lg border-l-4 border-[#173F35] shadow-sm">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs sm:text-sm font-bold text-[#C5A46D]">Rating: ★ {{ $review->rating }} / 5</span>
                                    <span class="px-2.5 py-0.5 text-xs rounded-full font-semibold {{ $review->status == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $review->status == 1 ? 'Approved' : 'Pending Approval' }}
                                    </span>
                                </div>
                                <p class="text-gray-700 text-sm leading-relaxed mb-2">{{ $review->comment }}</p>
                                <span class="text-xs text-gray-400 block text-right">{{ $review->created_at ? $review->created_at->format('M d, Y') : '' }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>