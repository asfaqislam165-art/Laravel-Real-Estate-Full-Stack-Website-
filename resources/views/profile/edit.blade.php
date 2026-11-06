<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-semibold text-xl sm:text-2xl text-[#173F35] leading-tight break-words">
            {{ __('Account Profile & Security') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F7F5EF] py-8 sm:py-12">
        <div class="max-w-7xl mx-auto space-y-5 sm:space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Update Profile Information --}}
            <section
                aria-label="{{ __('Update profile information') }}"
                class="min-w-0 rounded-lg border-l-4 border-[#C5A46D] bg-white p-4 shadow-sm sm:p-6 lg:p-8"
            >
                <div class="w-full min-w-0 max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            {{-- Update Password --}}
            <section
                aria-label="{{ __('Update password') }}"
                class="min-w-0 rounded-lg border-l-4 border-[#173F35] bg-white p-4 shadow-sm sm:p-6 lg:p-8"
            >
                <div class="w-full min-w-0 max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            {{-- Delete Account --}}
            <section
                aria-label="{{ __('Delete account') }}"
                class="min-w-0 rounded-lg border-l-4 border-red-500 bg-white p-4 shadow-sm sm:p-6 lg:p-8"
            >
                <div class="w-full min-w-0 max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>

        </div>
    </div>
</x-app-layout>