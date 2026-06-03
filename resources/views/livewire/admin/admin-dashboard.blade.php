<div class="space-y-8">
    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-slate-100 sm:text-3xl">Dashboard Overview</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400">Here's what's happening with Simplytek today.</p>
        </div>
        </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all dark:border-slate-800 dark:bg-slate-900 flex items-center space-x-4">
            <div class="p-3 bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Total Sales</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-slate-100 mt-0.5">LKR 245,500</p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all dark:border-slate-800 dark:bg-slate-900 flex items-center space-x-4">
            <div class="p-3 bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Total Orders</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-slate-100 mt-0.5">48 Orders</p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all dark:border-slate-800 dark:bg-slate-900 flex items-center space-x-4">
            <div class="p-3 bg-yellow-100 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Active Products</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-slate-100 mt-0.5">185 Items</p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition-all dark:border-slate-800 dark:bg-slate-900 flex items-center space-x-4">
            <div class="p-3 bg-purple-100 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Total Customers</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-slate-100 mt-0.5">1,240</p>
            </div>
        </div>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden dark:border-slate-800 dark:bg-slate-900">
        
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 dark:border-slate-800 dark:bg-slate-900/50">
            <h2 class="font-semibold text-gray-800 dark:text-slate-200">Recent Orders</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm min-w-[600px]">
                <thead>
                    <tr class="bg-gray-100/75 text-gray-600 uppercase text-xs font-semibold border-b border-gray-200 dark:bg-slate-800/40 dark:text-slate-400 dark:border-slate-800">
                        <th class="px-6 py-3.5">Order ID</th>
                        <th class="px-6 py-3.5">Customer</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Total</th>
                        <th class="px-6 py-3.5 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-slate-800 text-gray-700 dark:text-slate-300">
                    
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-slate-800/30 transition-colors">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-slate-100">#ST-9021</td>
                        <td class="px-6 py-4">Kasun Perera</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-500/10 dark:text-amber-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                Pending
                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium">LKR 45,000</td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700">View</a>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-slate-800/30 transition-colors">
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-slate-100">#ST-9020</td>
                        <td class="px-6 py-4">Nimal Silva</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-500/10 dark:text-emerald-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Completed
                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium">LKR 120,000</td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700">View</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>