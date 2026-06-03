<div class="h-screen flex flex-col overflow-hidden">
    
    <!-- Backdrop -->
    <div x-show="sidebarOpen" 
         class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm lg:hidden transition-opacity" 
         @click="sidebarOpen = false" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-50 flex h-full w-64 flex-col bg-white text-gray-600 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 border-r border-gray-200 overflow-hidden">
        
        <!-- Sidebar Top Header (Simplytek Admin) -->
        <div class="flex h-16 items-center justify-between px-6 bg-white border-b border-gray-200 shrink-0">
            <span class="text-xl font-bold tracking-wider text-cyan-600">Simplytek Admin</span>
            
            <!-- Mobile Close Button -->
            <button @click="sidebarOpen = false" 
                    class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 lg:hidden">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Sidebar Navigation Links -->
        <nav class="flex-1 space-y-1.5 px-4 py-6 overflow-y-auto custom-scrollbar">
            
            <!-- Dashboard Link -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center space-x-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 group
               {{ request()->routeIs('admin.dashboard') 
                  ? 'bg-cyan-50 text-cyan-600 font-semibold' 
                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="h-5 w-5 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-cyan-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Products Link -->
            <a href="#" 
               class="flex items-center space-x-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 group
               {{ request()->routeIs('admin.products') 
                  ? 'bg-cyan-50 text-cyan-600 font-semibold' 
                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="h-5 w-5 transition-colors {{ request()->routeIs('admin.products') ? 'text-cyan-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Products</span>
            </a>

            <!-- Orders Link -->
            <a href="#" 
               class="flex items-center space-x-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-150 group
               {{ request()->routeIs('admin.orders') 
                  ? 'bg-cyan-50 text-cyan-600 font-semibold' 
                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="h-5 w-5 transition-colors {{ request()->routeIs('admin.orders') ? 'text-cyan-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span>Orders</span>
            </a>

        </nav>

        <!-- Sidebar Bottom Footer (View Main Website) -->
        <div class="border-t border-gray-200 p-4 bg-white shrink-0">
            <a href="/" class="text-xs text-gray-500 hover:text-cyan-600 transition-colors flex items-center justify-between group">
                <span>&larr; View Main Website</span>
                <span class="opacity-0 group-hover:opacity-100 transition-opacity text-[10px] bg-gray-100 px-1.5 py-0.5 rounded text-gray-600">Home</span>
            </a>
        </div>
    </aside>
</div>