 @if (session('success'))
     <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
         class="flex items-start gap-3 p-4 mb-5 text-sm transition-none border rounded-md shadow-sm border-emerald-200 bg-emerald-50/60 text-emerald-800">
         <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
             <path fill-rule="evenodd"
                 d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                 clip-rule="evenodd" />
         </svg>
         <div class="flex-1 font-medium leading-tight">{{ session('success') }}</div>
         <button @click="show = false" class="transition-colors text-emerald-500 hover:text-emerald-700"
             aria-label="Dismiss">
             <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
             </svg>
         </button>
     </div>
 @endif
