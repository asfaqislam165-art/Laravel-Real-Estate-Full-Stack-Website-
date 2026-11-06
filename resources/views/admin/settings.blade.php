<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-2xl text-[#173F35]">
            Website Settings
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 bg-[#F7F5EF] min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white p-5 sm:p-8 rounded-lg shadow-sm border-t-4 border-[#173F35]">

            @if (session('status'))
                <div class="mb-6 p-3 sm:p-4 bg-green-100 text-green-700 rounded-md text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form
                action="{{ route('admin.settings.update', $setting->id) }}"
                method="POST"
                class="space-y-5 sm:space-y-6"
            >
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                    <div>
                        <label for="site_name" class="block text-sm font-semibold text-gray-700">
                            Site Name
                        </label>
                        <input
                            type="text"
                            id="site_name"
                            name="site_name"
                            value="{{ old('site_name', $setting->site_name) }}"
                            required
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                    </div>

                    <div>
                        <label for="contact_email" class="block text-sm font-semibold text-gray-700">
                            Contact Email
                        </label>
                        <input
                            type="email"
                            id="contact_email"
                            name="contact_email"
                            value="{{ old('contact_email', $setting->contact_email) }}"
                            required
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                        >
                    </div>
                </div>

                <div>
                    <label for="contact_phone" class="block text-sm font-semibold text-gray-700">
                        Contact Phone
                    </label>
                    <input
                        type="tel"
                        id="contact_phone"
                        name="contact_phone"
                        value="{{ old('contact_phone', $setting->contact_phone) }}"
                        required
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                    >
                </div>

                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-700">
                        Office Address
                    </label>
                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                        required
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35]"
                    >{{ old('address', $setting->address) }}</textarea>
                </div>

                <div class="pt-2">
                    <button
                        type="submit"
                        class="w-full sm:w-auto rounded-md bg-[#173F35] px-6 py-3 font-semibold text-[#C5A46D] transition hover:bg-[#102b24] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#173F35]"
                    >
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>