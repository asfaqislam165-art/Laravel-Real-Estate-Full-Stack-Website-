<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-[#173F35]">
            Edit Luxury Property
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 bg-[#F7F5EF] min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white p-5 sm:p-8 rounded-lg shadow-sm border-t-4 border-[#C5A46D]">

            @if (session('status'))
                <div class="mb-6 p-3 sm:p-4 bg-green-100 text-green-700 rounded-md text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form
                action="{{ route('admin.properties.update', $property->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700">
                            Property Title
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $property->title) }}"
                            required
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700">
                            Category
                        </label>
                        <select
                            id="category_id"
                            name="category_id"
                            required
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $property->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700">
                            Price ($)
                        </label>
                        <input
                            type="number"
                            id="price"
                            name="price"
                            step="0.01"
                            min="0"
                            value="{{ old('price', $property->price) }}"
                            required
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-semibold text-gray-700">
                            Location
                        </label>
                        <input
                            type="text"
                            id="location"
                            name="location"
                            value="{{ old('location', $property->location) }}"
                            required
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                    </div>

                    <div>
                        <label for="area_sqft" class="block text-sm font-semibold text-gray-700">
                            Area (sqft)
                        </label>
                        <input
                            type="number"
                            id="area_sqft"
                            name="area_sqft"
                            step="0.01"
                            min="0"
                            value="{{ old('area_sqft', $property->area_sqft) }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                    <div>
                        <label for="bedrooms" class="block text-sm font-semibold text-gray-700">
                            Bedrooms
                        </label>
                        <input
                            type="number"
                            id="bedrooms"
                            name="bedrooms"
                            min="0"
                            value="{{ old('bedrooms', $property->bedrooms) }}"
                            required
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                    </div>

                    <div>
                        <label for="bathrooms" class="block text-sm font-semibold text-gray-700">
                            Bathrooms
                        </label>
                        <input
                            type="number"
                            id="bathrooms"
                            name="bathrooms"
                            min="0"
                            value="{{ old('bathrooms', $property->bathrooms) }}"
                            required
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700">
                        Description
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        required
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                    >{{ old('description', $property->description) }}</textarea>
                </div>

                {{-- Current featured image and new uploads --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6 rounded-lg bg-[#F7F5EF] p-4 sm:p-5">
                    <div>
                        <label for="featured_image" class="block text-sm font-semibold text-gray-700">
                            Current Featured Image
                        </label>

                        @if ($property->featured_image)
                            <img
                                src="{{ asset('uploads/' . $property->featured_image) }}"
                                alt="Current featured image for {{ $property->title }}"
                                class="mt-2 h-32 w-full max-w-xs rounded-md object-cover"
                            >
                        @else
                            <p class="mt-2 text-sm text-gray-500">No featured image uploaded.</p>
                        @endif

                        <label for="featured_image" class="mt-3 block text-xs font-semibold text-gray-500">
                            Replace featured image
                        </label>

                        <input
                            type="file"
                            id="featured_image"
                            name="featured_image"
                            accept="image/*"
                            class="mt-1 w-full text-sm border border-gray-300 rounded-md file:mr-3 file:rounded-md file:border-0 file:bg-[#173F35] file:px-3 file:py-2 file:font-semibold file:text-[#C5A46D] hover:file:bg-[#102b24]"
                        >
                    </div>

                    <div>
                        <label for="images" class="block text-sm font-semibold text-gray-700">
                            Add More Gallery Images
                        </label>

                        <input
                            type="file"
                            id="images"
                            name="images[]"
                            multiple
                            accept="image/*"
                            class="mt-3 w-full text-sm border border-gray-300 rounded-md file:mr-3 file:rounded-md file:border-0 file:bg-[#173F35] file:px-3 file:py-2 file:font-semibold file:text-[#C5A46D] hover:file:bg-[#102b24]"
                        >
                    </div>
                </div>

                {{-- Existing gallery images --}}
                @if ($property->images->count() > 0)
                    <div>
                        <p class="text-sm font-semibold text-gray-700">
                            Existing Gallery Images
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            Use the × button to remove an individual image.
                        </p>

                        <div class="mt-3 grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-6">
                            @foreach ($property->images as $img)
                                <div class="relative overflow-hidden rounded-md border border-gray-200">
                                    <img
                                        src="{{ asset('uploads/' . $img->image_path) }}"
                                        alt="Gallery image for {{ $property->title }}"
                                        class="aspect-square w-full object-cover"
                                    >

                                    <form
                                        action="{{ route('admin.property.image.destroy', $img->id) }}"
                                        method="POST"
                                        class="absolute right-1 top-1"
                                        onsubmit="return confirm('Remove this image?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            aria-label="Remove gallery image"
                                            class="grid h-6 w-6 place-content-center rounded-full bg-red-600 text-xs font-bold text-white transition hover:bg-red-700"
                                        >
                                            ×
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex items-start gap-3">
                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        id="is_featured"
                        {{ old('is_featured', $property->is_featured) ? 'checked' : '' }}
                        class="mt-1 rounded border-gray-300 text-[#173F35] focus:ring-[#173F35]"
                    >
                    <label for="is_featured" class="text-sm font-semibold text-gray-700">
                        Mark as Featured Property on Homepage
                    </label>
                </div>

                <div class="pt-2">
                    <button
                        type="submit"
                        class="w-full sm:w-auto rounded-md bg-[#173F35] px-6 py-3 font-semibold text-[#C5A46D] transition hover:bg-[#102b24] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#173F35]"
                    >
                        Update Property
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>