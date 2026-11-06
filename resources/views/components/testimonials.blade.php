<div class="bg-[#173F35] py-12 sm:py-16 lg:py-20 text-[#F7F5EF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section heading --}}
        <div class="max-w-2xl mx-auto text-center mb-8 sm:mb-12 lg:mb-14">
            <span class="text-[#C5A46D] uppercase tracking-widest text-xs font-bold">
                Client Testimonials
            </span>

            <h2 class="mt-3 font-serif font-bold text-white text-2xl sm:text-3xl lg:text-4xl leading-tight">
                What Our Prestige Clients Say
            </h2>
        </div>

        @php
            $publishedReviews = \App\Models\Review::where('is_published', true)
                ->latest()
                ->take(6)
                ->get();
        @endphp

        {{-- Review cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">
            @forelse ($publishedReviews as $review)
                <article class="min-w-0 flex h-full flex-col justify-between rounded-lg border border-[#C5A46D]/20 bg-[#102b24] p-5 sm:p-6 lg:p-8 shadow-lg">
                    <div>
                        {{-- Star rating --}}
                        <div
                            class="mb-4 flex flex-wrap items-center gap-1 text-lg text-[#C5A46D]"
                            role="img"
                            aria-label="{{ $review->rating }} out of 5 stars"
                        >
                            @for ($i = 1; $i <= 5; $i++)
                                <span aria-hidden="true">
                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                </span>
                            @endfor
                        </div>

                        <blockquote class="mb-6 whitespace-pre-line break-words text-sm sm:text-base italic leading-relaxed text-gray-300">{{ $review->comment }}</blockquote>
                    </div>

                    {{-- Client details --}}
                    <div class="flex items-center gap-3 sm:gap-4 border-t border-gray-700/50 pt-4">
                        @if ($review->client_image)
                            <img
                                src="{{ asset('uploads/' . $review->client_image) }}"
                                alt="{{ $review->client_name }}"
                                loading="lazy"
                                width="48"
                                height="48"
                                class="h-12 w-12 shrink-0 rounded-full border border-[#C5A46D] object-cover"
                            >
                        @else
                            <div
                                aria-hidden="true"
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#C5A46D] text-lg font-bold text-[#173F35]"
                            >
                                {{ \Illuminate\Support\Str::upper(
                                    \Illuminate\Support\Str::substr($review->client_name, 0, 1)
                                ) }}
                            </div>
                        @endif

                        <div class="min-w-0">
                            <h3 class="break-words font-serif font-bold text-sm sm:text-base text-white">
                                {{ $review->client_name }}
                            </h3>

                            @if ($review->client_role)
                                <p class="mt-1 break-words text-xs sm:text-sm text-[#C5A46D]">
                                    {{ $review->client_role }}
                                </p>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-lg border border-[#C5A46D]/20 bg-[#102b24] p-6 sm:p-8 text-center">
                    <p class="text-sm text-gray-300">
                        Client testimonials will appear here soon.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>