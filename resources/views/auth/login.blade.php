<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-serif font-bold text-2xl text-[#173F35]">Welcome Back</h2>
        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Access Your LuxeEstate Portal</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35] text-sm py-2.5 px-3">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Password</label>
            <input type="password" name="password" required autocomplete="current-password" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#173F35] focus:ring-[#173F35] text-sm py-2.5 px-3">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-xs" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-sm pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#173F35] shadow-sm focus:ring-[#173F35]" name="remember">
                <span class="ms-2 text-gray-600 text-xs uppercase font-medium">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-[#173F35] hover:underline font-semibold" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full bg-[#173F35] text-[#C5A46D] font-semibold py-3 rounded-md hover:bg-[#102b24] transition uppercase tracking-wider text-xs shadow-sm">
                {{ __('Sign In to Account') }}
            </button>
        </div>

        <!-- Register Link -->
        <div class="text-center pt-4 border-t border-gray-100 mt-4">
            <p class="text-xs text-gray-600">
                Don't have an executive account? 
                <a href="{{ route('register') }}" class="text-[#173F35] font-bold hover:underline">Register now</a>
            </p>
        </div>
    </form>
</x-guest-layout>