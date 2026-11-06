<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-[#173F35]">
            Property Categories Management
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 bg-[#F7F5EF] min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Add Category Form -->
            <div class="bg-white p-5 sm:p-6 rounded-lg shadow-sm h-fit border-t-4 border-[#173F35]">
                <h3 class="font-serif font-bold text-lg text-[#173F35] mb-4">
                    Add New Category
                </h3>

                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-xs">
                        {{ session('status') }}
                    </div>
                @endif

                <form
                    action="{{ route('admin.categories.store') }}"
                    method="POST"
                    class="space-y-4"
                >
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-bold text-gray-700 uppercase">
                            Category Name
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            class="w-full mt-1 border-gray-300 rounded-md text-sm shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#173F35] text-[#C5A46D] py-2.5 rounded-md font-semibold text-sm hover:bg-[#102b24] transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#173F35]"
                    >
                        Add Category
                    </button>
                </form>
            </div>

            <!-- Categories Table -->
            <div class="lg:col-span-2 bg-white p-5 sm:p-6 rounded-lg shadow-sm">
                <h3 class="font-serif font-bold text-lg text-[#173F35] mb-4">
                    All Categories
                </h3>

                @if ($categories->isEmpty())
                    <p class="text-sm text-gray-500">
                        No categories have been added yet.
                    </p>
                @else
                    <!-- Desktop table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">Name</th>
                                    <th class="px-4 py-3 text-left font-semibold">Slug</th>
                                    <th class="px-4 py-3 text-left font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td class="px-4 py-3 font-semibold text-[#173F35]">
                                            {{ $cat->name }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-500">
                                            {{ $cat->slug }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <form
                                                action="{{ route('admin.categories.destroy', $cat->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete category?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-red-600 font-bold hover:underline"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile cards -->
                    <div class="md:hidden space-y-4">
                        @foreach ($categories as $cat)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="font-semibold text-[#173F35]">
                                            {{ $cat->name }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1 break-all">
                                            {{ $cat->slug }}
                                        </p>
                                    </div>

                                    <form
                                        action="{{ route('admin.categories.destroy', $cat->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete category?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600 font-bold text-sm hover:underline"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>