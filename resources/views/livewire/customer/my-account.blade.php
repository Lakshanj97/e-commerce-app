<div>
    <div class="max-w-7xl mx-auto px-4 py-8 pt-28">

        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Account</h1>
            <p class="text-gray-500 text-sm mt-1">Welcome back, <span class="font-semibold text-indigo-600">{{ auth()->user()->full_name }}</span></p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">

            {{-- ─── Left Sidebar Tabs ──────────────────────────────── --}}
            <aside class="w-full lg:w-60 shrink-0">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                    {{-- Avatar --}}
                    <div class="p-6 text-center border-b border-gray-100">
                        <div class="w-16 h-16 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xl font-bold mx-auto mb-3">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <p class="font-semibold text-gray-800 text-sm">{{ auth()->user()->full_name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 truncate">{{ auth()->user()->email }}</p>
                    </div>

                    {{-- Nav Items --}}
                    <nav class="p-2">
                        @foreach ([
                            ['tab' => 'profile', 'label' => 'My Profile', 'icon' => 'M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                            ['tab' => 'orders', 'label' => 'My Orders', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                            ['tab' => 'security', 'label' => 'Security', 'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'],
                        ] as $item)
                            <button wire:click="setTab('{{ $item['tab'] }}')"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition {{ $activeTab === $item['tab'] ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                                </svg>
                                {{ $item['label'] }}
                            </button>
                        @endforeach
                    </nav>

                    {{-- Logout --}}
                    <div class="p-2 border-t border-gray-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 transition">
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            {{-- ─── Right Content Panel ────────────────────────────── --}}
            <div class="flex-1">

                {{-- ── PROFILE TAB ── --}}
                @if ($activeTab === 'profile')
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-lg font-bold text-gray-800 mb-6">Personal Information</h2>

                        @if (session('profileSuccess'))
                            <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium">
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ session('profileSuccess') }}
                            </div>
                        @endif

                        <form wire:submit="updateProfile" class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">First Name</label>
                                    <input wire:model="firstName" type="text" placeholder="John"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    @error('firstName') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Last Name</label>
                                    <input wire:model="lastName" type="text" placeholder="Doe"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    @error('lastName') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Display Name</label>
                                <input wire:model="name" type="text" placeholder="Display name"
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                                <input type="email" value="{{ auth()->user()->email }}" disabled
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-100 bg-gray-50 text-sm text-gray-500 cursor-not-allowed">
                                <p class="text-xs text-gray-400 mt-1">Email cannot be changed. Contact support if needed.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone Number</label>
                                <input wire:model="phone" type="tel" placeholder="+94 77 123 4567"
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="pt-2">
                                <button type="submit" wire:loading.attr="disabled"
                                    class="px-6 py-3 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition shadow-sm">
                                    <span wire:loading.remove wire:target="updateProfile">Save Changes</span>
                                    <span wire:loading wire:target="updateProfile">Saving…</span>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                {{-- ── ORDERS TAB ── --}}
                @if ($activeTab === 'orders')
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-lg font-bold text-gray-800 mb-6">Order History</h2>

                        @if ($orders instanceof \Illuminate\Pagination\LengthAwarePaginator && $orders->isNotEmpty())
                            <div class="space-y-4">
                                @foreach ($orders as $order)
                                    <div class="border border-gray-100 rounded-2xl overflow-hidden hover:border-indigo-200 hover:shadow-sm transition" wire:key="order-{{ $order->id }}">
                                        <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-4 bg-gray-50 border-b border-gray-100">
                                            <div class="flex flex-wrap items-center gap-4">
                                                <div>
                                                    <p class="text-xs text-gray-400">Order #</p>
                                                    <p class="text-sm font-bold text-gray-800">{{ $order->order_number }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-400">Date</p>
                                                    <p class="text-sm font-medium text-gray-700">{{ $order->created_at->format('d M Y') }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-400">Total</p>
                                                    <p class="text-sm font-bold text-gray-900">Rs. {{ number_format($order->total_amount, 2) }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <x-common.admin.badges.status :status="$order->status" />
                                                <x-common.admin.badges.status :status="$order->payment_status" />
                                            </div>
                                        </div>

                                        {{-- Items preview --}}
                                        <div class="px-6 py-4">
                                            <div class="flex flex-wrap gap-3">
                                                @foreach ($order->items->take(3) as $item)
                                                    <div class="flex items-center gap-2">
                                                        @if ($item->product_image)
                                                            <img src="{{ $item->product_image }}" alt="{{ $item->product_name }}"
                                                                class="w-10 h-10 object-contain rounded-lg bg-gray-50 border border-gray-100">
                                                        @endif
                                                        <div>
                                                            <p class="text-xs font-medium text-gray-700 line-clamp-1 max-w-[140px]">{{ $item->product_name }}</p>
                                                            <p class="text-xs text-gray-400">× {{ $item->quantity }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if ($order->items->count() > 3)
                                                    <div class="flex items-center">
                                                        <span class="text-xs text-gray-400">+{{ $order->items->count() - 3 }} more</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6">
                                {{ $orders->links() }}
                            </div>

                        @else
                            <div class="flex flex-col items-center justify-center py-16 text-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-600 mb-1">No orders yet</h3>
                                <p class="text-sm text-gray-400 mb-5">You haven't placed any orders. Start shopping!</p>
                                <a href="{{ route('shop') }}"
                                    class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition">
                                    Shop Now
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- ── SECURITY TAB ── --}}
                @if ($activeTab === 'security')
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-lg font-bold text-gray-800 mb-6">Change Password</h2>

                        @if (session('passwordSuccess'))
                            <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium">
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ session('passwordSuccess') }}
                            </div>
                        @endif

                        <form wire:submit="changePassword" class="space-y-5 max-w-md">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Current Password</label>
                                <input wire:model="currentPassword" type="password" placeholder="Enter current password"
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @error('currentPassword') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">New Password</label>
                                <input wire:model="newPassword" type="password" placeholder="Min 8 characters"
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @error('newPassword') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm New Password</label>
                                <input wire:model="newPasswordConfirmation" type="password" placeholder="Re-enter new password"
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div class="pt-2">
                                <button type="submit" wire:loading.attr="disabled"
                                    class="px-6 py-3 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition shadow-sm">
                                    <span wire:loading.remove wire:target="changePassword">Update Password</span>
                                    <span wire:loading wire:target="changePassword">Updating…</span>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
