<div class="min-h-[calc(100vh-160px)] flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-50 pt-28 pb-16">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
        {{-- Header --}}
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600/10 text-blue-600 mb-4 shadow-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Create your account
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Join SimplyTek to track orders, manage your profile, and enjoy faster checkout.
            </p>
        </div>
    </div>

    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-lg px-4">
        <div class="bg-white py-8 px-6 shadow-xl shadow-gray-200/50 rounded-2xl border border-gray-100 sm:px-10">
            <form wire:submit.prevent="register" class="space-y-4">
                {{-- First & Last Name Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- First Name --}}
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-1">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            wire:model="first_name"
                            id="first_name"
                            type="text"
                            required
                            placeholder="John"
                            class="block w-full px-3.5 py-2.5 rounded-xl border {{ $errors->has('first_name') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-blue-600 focus:ring-blue-600' }} text-sm placeholder-gray-400 transition focus:outline-none focus:ring-2"
                        />
                        @error('first_name')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-1">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            wire:model="last_name"
                            id="last_name"
                            type="text"
                            required
                            placeholder="Doe"
                            class="block w-full px-3.5 py-2.5 rounded-xl border {{ $errors->has('last_name') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-blue-600 focus:ring-blue-600' }} text-sm placeholder-gray-400 transition focus:outline-none focus:ring-2"
                        />
                        @error('last_name')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Email Address --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                        Email address <span class="text-red-500">*</span>
                    </label>
                    <input
                        wire:model="email"
                        id="email"
                        type="email"
                        required
                        placeholder="john.doe@example.com"
                        class="block w-full px-3.5 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-blue-600 focus:ring-blue-600' }} text-sm placeholder-gray-400 transition focus:outline-none focus:ring-2"
                    />
                    @error('email')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone Number --}}
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">
                        Phone Number <span class="text-gray-400 font-normal text-xs">(Optional)</span>
                    </label>
                    <input
                        wire:model="phone"
                        id="phone"
                        type="tel"
                        placeholder="+94 77 123 4567"
                        class="block w-full px-3.5 py-2.5 rounded-xl border {{ $errors->has('phone') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-blue-600 focus:ring-blue-600' }} text-sm placeholder-gray-400 transition focus:outline-none focus:ring-2"
                    />
                    @error('phone')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-data="{ showPass: false }">
                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-semibold text-gray-700">
                                Password <span class="text-red-500">*</span>
                            </label>
                        </div>
                        <div class="relative">
                            <input
                                wire:model="password"
                                id="password"
                                :type="showPass ? 'text' : 'password'"
                                required
                                placeholder="Min. 8 chars"
                                class="block w-full px-3.5 pr-10 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-blue-600 focus:ring-blue-600' }} text-sm placeholder-gray-400 transition focus:outline-none focus:ring-2"
                            />
                            <button
                                type="button"
                                @click="showPass = !showPass"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition"
                            >
                                <svg x-show="!showPass" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPass" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                                Confirm <span class="text-red-500">*</span>
                            </label>
                        </div>
                        <input
                            wire:model="password_confirmation"
                            id="password_confirmation"
                            :type="showPass ? 'text' : 'password'"
                            required
                            placeholder="Re-type password"
                            class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 focus:border-blue-600 focus:ring-blue-600 text-sm placeholder-gray-400 transition focus:outline-none focus:ring-2"
                        />
                    </div>
                </div>

                {{-- Terms & Conditions --}}
                <div class="pt-2">
                    <label class="flex items-start cursor-pointer">
                        <input
                            wire:model="terms"
                            type="checkbox"
                            class="h-4 w-4 mt-0.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition"
                        />
                        <span class="ml-2 text-xs text-gray-600">
                            I agree to SimplyTek's <span class="text-blue-600 underline">Terms of Service</span> and <span class="text-blue-600 underline">Privacy Policy</span>.
                        </span>
                    </label>
                    @error('terms')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full flex justify-center items-center py-3 px-4 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition-all shadow-md shadow-blue-500/20 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <svg wire:loading wire:target="register" class="animate-spin -ml-1 mr-2.5 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="register">Create Account</span>
                        <span wire:loading wire:target="register">Creating Account...</span>
                    </button>
                </div>
            </form>

            {{-- Sign In Link --}}
            <div class="mt-6 text-center text-sm text-gray-500 border-t border-gray-100 pt-6">
                Already have an account?
                <a href="{{ route('login') }}" wire:navigate class="font-semibold text-blue-600 hover:text-blue-700 transition ml-1">
                    Sign in here
                </a>
            </div>
        </div>
    </div>
</div>
