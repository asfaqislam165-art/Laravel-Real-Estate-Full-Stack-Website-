<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-[#173F35]">
            Customer Inquiries & Leads
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

                @if ($inquiries->isEmpty())
                    <p class="rounded-lg border border-dashed border-gray-300 p-6 text-center text-sm text-gray-500">
                        No inquiries yet.
                    </p>
                @endif

                {{-- Desktop table --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Client Name</th>
                                <th class="px-4 py-3 text-left font-semibold">Contact Info</th>
                                <th class="px-4 py-3 text-left font-semibold">Property</th>
                                <th class="px-4 py-3 text-left font-semibold">Message</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                                <th class="px-4 py-3 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($inquiries as $inq)
                                <tr class="align-top">
                                    <td class="px-4 py-3 font-semibold text-gray-900">
                                        {{ $inq->name }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <a href="tel:{{ $inq->phone }}"
                                            class="block font-bold text-[#173F35] hover:underline">
                                            📞 {{ $inq->phone }}
                                        </a>

                                        <a href="mailto:{{ $inq->email }}"
                                            class="block text-indigo-600 hover:underline">
                                            ✉️ {{ $inq->email }}
                                        </a>

                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->phone) }}"
                                            target="_blank"
                                            rel="noopener"
                                            class="block font-semibold text-green-600 hover:underline">
                                            💬 WhatsApp
                                        </a>
                                    </td>

                                    <td class="px-4 py-3 font-medium text-[#173F35]">
                                        {{ $inq->property->title ?? 'General Inquiry' }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        <span class="line-clamp-3 max-w-xs">
                                            {{ $inq->message }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="inline-block rounded-full px-2.5 py-1 text-xs font-semibold
                                            @if($inq->status === 'Closed')
                                                bg-green-100 text-green-800
                                            @elseif($inq->status === 'Contacted')
                                                bg-blue-100 text-blue-800
                                            @else
                                                bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ $inq->status }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="space-y-2">
                                            <form action="{{ route('admin.inquiries.status', $inq->id) }}"
                                                method="POST">
                                                @csrf

                                                <select name="status"
                                                    onchange="this.form.submit()"
                                                    class="w-full rounded-md border-gray-300 text-xs shadow-sm focus:border-[#173F35] focus:ring-[#173F35]">
                                                    <option value="New" {{ $inq->status === 'New' ? 'selected' : '' }}>New</option>
                                                    <option value="Contacted" {{ $inq->status === 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                                    <option value="Closed" {{ $inq->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                                                </select>
                                            </form>

                                            <form action="{{ route('admin.inquiries.destroy', $inq->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete inquiry?');">
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
                    @foreach ($inquiries as $inq)
                        <div class="rounded-lg border border-gray-200 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-gray-900">
                                        {{ $inq->name }}
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-[#173F35]">
                                        {{ $inq->property->title ?? 'General Inquiry' }}
                                    </p>
                                </div>

                                <span class="shrink-0 rounded-full px-2.5 py-1 text-xs font-semibold
                                    @if($inq->status === 'Closed')
                                        bg-green-100 text-green-800
                                    @elseif($inq->status === 'Contacted')
                                        bg-blue-100 text-blue-800
                                    @else
                                        bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ $inq->status }}
                                </span>
                            </div>

                            <div class="mt-3 space-y-1 text-sm">
                                <a href="tel:{{ $inq->phone }}"
                                    class="block font-bold text-[#173F35] hover:underline">
                                    📞 {{ $inq->phone }}
                                </a>

                                <a href="mailto:{{ $inq->email }}"
                                    class="block break-all text-indigo-600 hover:underline">
                                    ✉️ {{ $inq->email }}
                                </a>

                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->phone) }}"
                                    target="_blank"
                                    rel="noopener"
                                    class="block font-semibold text-green-600 hover:underline">
                                    💬 WhatsApp
                                </a>
                            </div>

                            <p class="mt-3 rounded-md bg-[#F7F5EF] p-3 text-sm text-gray-600">
                                {{ $inq->message }}
                            </p>

                            <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <form action="{{ route('admin.inquiries.status', $inq->id) }}"
                                    method="POST"
                                    class="w-full sm:w-auto">
                                    @csrf

                                    <select name="status"
                                        onchange="this.form.submit()"
                                        class="w-full rounded-md border-gray-300 text-xs shadow-sm focus:border-[#173F35] focus:ring-[#173F35]">
                                        <option value="New" {{ $inq->status === 'New' ? 'selected' : '' }}>New</option>
                                        <option value="Contacted" {{ $inq->status === 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                        <option value="Closed" {{ $inq->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>

                                <form action="{{ route('admin.inquiries.destroy', $inq->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete inquiry?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="w-full rounded-md border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-100 sm:w-auto">
                                        Delete Inquiry
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