<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-[#173F35]">
            Add New Luxury Property
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 bg-[#F7F5EF] min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white p-5 sm:p-8 rounded-lg shadow-sm border-t-4 border-[#173F35]">

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-md text-sm">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('admin.properties.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700">
                            Property Title
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
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
                            @foreach (\App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
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
                    ></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                    <div>
                        <label for="featured_image" class="block text-sm font-semibold text-gray-700">
                            Featured Image
                        </label>
                        <input
                            type="file"
                            id="featured_image"
                            name="featured_image"
                            accept="image/*"
                            class="mt-1 w-full text-sm border border-gray-300 rounded-md file:mr-3 file:py-2 file:px-3 file:rounded-md file:border-0 file:bg-[#173F35] file:text-[#C5A46D] file:font-semibold hover:file:bg-[#102b24]"
                        >
                    </div>

                    <div>
                        <label for="images" class="block text-sm font-semibold text-gray-700">
                            Multiple Gallery Images
                        </label>
                        <input
                            type="file"
                            id="images"
                            name="images[]"
                            multiple
                            accept="image/*"
                            class="mt-1 w-full text-sm border border-gray-300 rounded-md file:mr-3 file:py-2 file:px-3 file:rounded-md file:border-0 file:bg-[#173F35] file:text-[#C5A46D] file:font-semibold hover:file:bg-[#102b24]"
                        >
                    </div>
                </div>

                <div class="flex items-start sm:items-center gap-3">
                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        id="is_featured"
                        class="mt-1 sm:mt-0 rounded border-gray-300 text-[#173F35] focus:ring-[#173F35]"
                    >
                    <label for="is_featured" class="text-sm font-semibold text-gray-700">
                        Mark as Featured Property on Homepage
                    </label>
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full sm:w-auto bg-[#173F35] text-[#C5A46D] px-6 py-3 rounded-md font-semibold hover:bg-[#102b24] transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#173F35]"
                    >
                        Save Property
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>