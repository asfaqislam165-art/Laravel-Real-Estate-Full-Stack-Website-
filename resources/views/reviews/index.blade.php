<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-[#173F35] leading-tight">
            {{ __('Manage Property Reviews') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#F7F5EF] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6 border-t-4 border-[#C5A46D]">
                <h3 class="text-lg font-serif font-bold text-[#173F35] mb-4">All User Reviews</h3>

                @if(isset($reviews) && count($reviews) > 0)
                    <!-- Desktop / Tablet Table View -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-[#173F35] text-[#F7F5EF]">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">User Name</th>
                                    <th class="px-4 py-3 text-left font-semibold">Comment</th>
                                    <th class="px-4 py-3 text-left font-semibold">Rating</th>
                                    <th class="px-4 py-3 text-left font-semibold">Status</th>
                                    <th class="px-4 py-3 text-right font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($reviews as $review)
                                    <tr>
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $review->name ?? $review->client_name }}</td>
                                        <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $review->comment }}</td>
                                        <td class="px-4 py-3 text-[#C5A46D] font-bold">★ {{ $review->rating }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $statusVal = $review->status ?? $review->is_published ?? 0;
                                            @endphp
                                            <span class="px-2 py-1 text-xs rounded {{ $statusVal == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $statusVal == 1 ? 'Approved' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-right space-x-2">
                                            <form action="{{ route('admin.reviews.toggle', $review->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-xs text-[#173F35] font-bold hover:underline">Toggle Status</button>
                                            </form>
                                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this review?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-600 font-bold hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Responsive Card View -->
                    <div class="md:hidden space-y-4">
                        @foreach($reviews as $review)
                            <div class="bg-[#F7F5EF] p-4 rounded-lg border border-gray-200 shadow-sm">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold text-gray-900 text-base">{{ $review->name ?? $review->client_name }}</h4>
                                    <span class="text-[#C5A46D] font-bold text-sm">★ {{ $review->rating }} / 5</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3 italic">"{{ $review->comment }}"</p>
                                
                                <div class="flex justify-between items-center pt-2 border-t border-gray-300">
                                    <div>
                                        @php
                                            $statusVal = $review->status ?? $review->is_published ?? 0;
                                        @endphp
                                        <span class="px-2 py-0.5 text-xs rounded {{ $statusVal == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $statusVal == 1 ? 'Approved' : 'Pending' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <form action="{{ route('admin.reviews.toggle', $review->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-xs text-[#173F35] font-bold hover:underline">Toggle</button>
                                        </form>
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 font-bold hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No reviews found in the system.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>