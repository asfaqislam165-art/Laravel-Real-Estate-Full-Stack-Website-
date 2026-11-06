<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-serif font-semibold text-2xl text-[#173F35]">
                Manage Properties
            </h2>

            <a href="{{ route('admin.properties.create') }}"
                class="inline-flex w-full items-center justify-center rounded-md bg-[#173F35] px-5 py-2.5 text-sm font-semibold text-[#C5A46D] transition hover:bg-[#102b24] sm:w-auto">
                Add Property
            </a>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12 bg-[#F7F5EF] min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6">

                @if (session('status'))
                    <div class="mb-4 p-3 sm:p-4 bg-green-100 text-green-700 rounded-md text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($properties->isEmpty())
                    <p class="rounded-lg border border-dashed border-gray-300 p-6 text-center text-sm text-gray-500">
                        No properties have been added yet.
                    </p>
                @endif

                {{-- Desktop table --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Image</th>
                                <th class="px-4 py-3 text-left font-semibold">Title</th>
                                <th class="px-4 py-3 text-left font-semibold">Category</th>
                                <th class="px-4 py-3 text-left font-semibold">Price</th>
                                <th class="px-4 py-3 text-left font-semibold">Location</th>
                                <th class="px-4 py-3 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($properties as $property)
                                <tr>
                                    <td class="px-4 py-3">
                                        @if ($property->featured_image)
                                            <img
                                                src="{{ asset('uploads/' . $property->featured_image) }}"
                                                alt="{{ $property->title }}"
                                                class="h-12 w-12 rounded-md object-cover"
                                            >
                                        @else
                                            <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 font-semibold text-gray-900">
                                        {{ $property->title }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $property->category->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-4 py-3 font-serif font-bold text-[#173F35]">
                                        ${{ number_format($property->price, 2) }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $property->location }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('admin.properties.edit', $property->id) }}"
                                                class="font-bold text-indigo-600 hover:underline">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.properties.destroy', $property->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete property?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="font-bold text-red-600 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile cards --}}
                <div class="space-y-4 md:hidden">
                    @foreach ($properties as $property)
                        <div class="overflow-hidden rounded-lg border border-gray-200">
                            <div class="flex gap-4 p-4">
                                @if ($property->featured_image)
                                    <img
                                        src="{{ asset('uploads/' . $property->featured_image) }}"
                                        alt="{{ $property->title }}"
                                        class="h-20 w-20 shrink-0 rounded-md object-cover"
                                    >
                                @else
                                    <div class="grid h-20 w-20 shrink-0 place-content-center rounded-md bg-[#F7F5EF] text-xs text-gray-400">
                                        No image
                                    </div>
                                @endif

                                <div class="min-w-0">
                                    <h3 class="truncate font-semibold text-gray-900">
                                        {{ $property->title }}
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ $property->category->name ?? 'N/A' }}
                                    </p>

                                    <p class="mt-1 font-serif font-bold text-[#173F35]">
                                        ${{ number_format($property->price, 2) }}
                                    </p>

                                    <p class="mt-1 text-sm text-gray-600">
                                        📍 {{ $property->location }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between border-t border-gray-200 bg-gray-50 px-4 py-3">
                                <a href="{{ route('admin.properties.edit', $property->id) }}"
                                    class="rounded-md border border-indigo-200 bg-indigo-50 px-3 py-2 text-xs font-bold text-indigo-600 hover:bg-indigo-100">
                                    Edit
                                </a>

                                <form action="{{ route('admin.properties.destroy', $property->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete property?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="rounded-md border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-100">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>