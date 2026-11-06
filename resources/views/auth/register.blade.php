<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-serif font-bold text-2xl text-[#173F35]">Create Account</h2>
        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Join LuxeEstate Living Today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35] text-sm py-2.5 px-3">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-xs" />
        </div>

        <!-- Email Address -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35] text-sm py-2.5 px-3">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Password</label>
            <input type="password" name="password" required autocomplete="new-password" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35] text-sm py-2.5 px-3">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" required autocomplete="new-password" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35] text-sm py-2.5 px-3">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-xs" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full bg-[#173F35] text-[#C5A46D] font-semibold py-3 rounded-md hover:bg-[#102b24] transition uppercase tracking-wider text-xs shadow-sm">
                {{ __('Create Executive Account') }}
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center pt-4 border-t border-gray-100 mt-4">
            <p class="text-xs text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-[#173F35] font-bold hover:underline">Sign In here</a>
            </p>
        </div>
    </form>
</x-guest-layout>