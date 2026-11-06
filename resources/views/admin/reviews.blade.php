<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-[#173F35]">
            Client Reviews & Ratings
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 bg-[#F7F5EF] min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6">

                @if (session('status'))
                    <div class="mb-4 p-3 sm:p-4 bg-green-100 text-green-700 rounded-md text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($reviews->isEmpty())
                    <p class="rounded-lg border border-dashed border-gray-300 p-6 text-center text-sm text-gray-500">
                        No client reviews yet.
                    </p>
                @endif

                {{-- Desktop table --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Client</th>
                                <th class="px-4 py-3 text-left font-semibold">Rating</th>
                                <th class="px-4 py-3 text-left font-semibold">Comment</th>
                                <th class="px-4 py-3 text-left font-semibold">Property</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                                <th class="px-4 py-3 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($reviews as $rev)
                                <tr class="align-top">
                                    <td class="px-4 py-3 font-semibold text-gray-900">
                                        {{ $rev->client_name }}

                                        <span class="block text-xs font-normal text-gray-500">
                                            {{ $rev->client_role }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 font-bold text-[#C5A46D]">
                                        {{ str_repeat('★', $rev->rating) }}
                                        <span class="block text-xs font-normal text-gray-500">
                                            {{ $rev->rating }}/5
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        <span class="line-clamp-3 max-w-xs">
                                            {{ $rev->comment }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 font-medium text-[#173F35]">
                                        {{ $rev->property->title ?? 'General Review' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="inline-block rounded-full px-2.5 py-1 text-xs font-semibold {{ $rev->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $rev->is_published ? 'Published' : 'Hidden' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <form action="{{ route('admin.reviews.toggle', $rev->id) }}"
                                                method="POST">
                                                @csrf

                                                <button type="submit"
                                                    class="text-xs font-bold text-indigo-600 hover:underline">
                                                    {{ $rev->is_published ? 'Hide' : 'Publish' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.reviews.destroy', $rev->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this review?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="text-xs font-bold text-red-600 hover:underline">
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
                    @foreach ($reviews as $rev)
                        <div class="rounded-lg border border-gray-200 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-gray-900">
                                        {{ $rev->client_name }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $rev->client_role }}
                                    </p>
                                </div>

                                <span class="shrink-0 rounded-full px-2.5 py-1 text-xs font-semibold {{ $rev->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $rev->is_published ? 'Published' : 'Hidden' }}
                                </span>
                            </div>

                            <p class="mt-3 font-bold text-[#C5A46D]">
                                {{ str_repeat('★', $rev->rating) }}
                                <span class="ml-1 text-xs font-normal text-gray-500">
                                    {{ $rev->rating }}/5
                                </span>
                            </p>

                            <p class="mt-3 rounded-md bg-[#F7F5EF] p-3 text-sm text-gray-600">
                                {{ $rev->comment }}
                            </p>

                            <p class="mt-3 text-sm font-medium text-[#173F35]">
                                🏠 {{ $rev->property->title ?? 'General Review' }}
                            </p>

                            <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <form action="{{ route('admin.reviews.toggle', $rev->id) }}"
                                    method="POST"
                                    class="w-full sm:w-auto">
                                    @csrf

                                    <button type="submit"
                                        class="w-full rounded-md border border-indigo-200 bg-indigo-50 px-3 py-2 text-xs font-bold text-indigo-600 hover:bg-indigo-100 sm:w-auto">
                                        {{ $rev->is_published ? 'Hide Review' : 'Publish Review' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.reviews.destroy', $rev->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this review?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="w-full rounded-md border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-100 sm:w-auto">
                                        Delete Review
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