<header class="flex h-16 items-center justify-between border-b border-gray-200 bg-white px-4 shadow-sm transition-colors duration-200 dark:border-slate-800 dark:bg-slate-900 sm:px-6">
    
    <div class="flex items-center space-x-3 sm:space-x-4">
        <button @click="sidebarOpen = true" class="rounded-lg p-1 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:text-gray-400 dark:hover:bg-slate-800 dark:hover:text-gray-200 lg:hidden">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        
        <div class="hidden sm:block text-sm font-medium text-gray-500 dark:text-gray-400">
            Welcome back, <span class="font-semibold text-gray-800 dark:text-slate-200">Admin</span>!
        </div>
    </div>

    <div class="relative flex items-center space-x-4" x-data="{ userMenuOpen: false }">
        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-2 rounded-full p-1 focus:outline-none focus:ring-2 focus:ring-cyan-500 md:rounded-lg md:px-3 md:py-1.5 md:hover:bg-gray-50 md:dark:hover:bg-slate-800">
            <img class="h-8 w-8 rounded-full border border-gray-200 dark:border-slate-700 bg-gray-200" src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff" alt="Admin">
            <span class="hidden md:block text-sm font-medium text-gray-700 dark:text-slate-300">Admin Account</span>
            <svg class="hidden h-4 w-4 text-gray-500 dark:text-gray-400 md:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div x-show="userMenuOpen" 
             @click.away="userMenuOpen = false" 
             class="absolute right-0 top-12 z-50 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 transition-all dark:bg-slate-800 dark:ring-white/10" 
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             style="display: none;">
            
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-700/50">Your Profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-700/50">Settings</a>
            
            <hr class="my-1 border-gray-200 dark:border-slate-700">
            
            <button class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-slate-700/50">Logout</button>
        </div>
    </div>
</header>