<div >

    {{-- Flash Messages --}}
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

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show"
            class="flex items-start gap-3 p-4 mb-5 text-sm text-red-800 transition-none border border-red-200 rounded-md shadow-sm bg-red-50/60">

            <svg class="w-5 h-5 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>

            <div class="flex-1 font-medium leading-tight">{{ session('error') }}</div>

            <button @click="show = false" class="text-red-500 transition-colors hover:text-red-700"
                aria-label="Dismiss">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    {{-- Main Card --}}
    <div  class="w-full overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-[0_2px_10px_-3px_rgba(0,0,0,0.05)]"">

        <form wire:submit.prevent="save" autocomplete="off">

            {{-- Page Header --}}
            <div class="flex items-center justify-between px-8 pt-6 mb-1">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Company Profile</h1>
                    <p class="mt-1 text-sm text-gray-500">Manage your company information and branding</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 p-8 md:grid-cols-2">

                {{-- Left Column: Company Information --}}
                <div class="space-y-6">
                    <div class="pb-3 border-b border-gray-100">
                        <h2 class="text-base font-semibold text-gray-800">Company Information</h2>
                        <p class="mt-1 text-sm text-gray-500">Basic details about your company.</p>
                    </div>

                    {{-- Company Name --}}
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Company Name
                        </label>
                        <input type="text" id="company_name" wire:model="company_name"
                            placeholder="e.g. Acme Corporation"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500
                            @error('company_name') border-red-400 focus:border-red-400 focus:ring-red-400 @enderror" />
                        @error('company_name')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tax Number --}}
                    <div>
                        <label for="tax_number" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Tax Number
                        </label>
                        <input type="text" id="tax_number" wire:model="tax_number" placeholder="e.g. 134567890V"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500
                            @error('tax_number') border-red-400 focus:border-red-400 focus:ring-red-400 @enderror" />
                        @error('tax_number')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Phone Number
                        </label>
                        <input type="tel" id="phone" wire:model="phone" placeholder="e.g. +94 11 234 5678"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500
                            @error('phone') border-red-400 focus:border-red-400 focus:ring-red-400 @enderror" />
                        @error('phone')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Email Address
                        </label>
                        <input type="email" id="email" wire:model="email" placeholder="e.g. info@company.com"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500
                            @error('email') border-red-400 focus:border-red-400 focus:ring-red-400 @enderror" />
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Address
                        </label>
                        <textarea id="address" wire:model="address" rows="3" placeholder="Enter company address..."
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition focus:bg-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 resize-none
                            @error('address') border-red-400 focus:border-red-400 focus:ring-red-400 @enderror"></textarea>
                        @error('address')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Right Column: Logo --}}
                <div class="space-y-6">
                    <div class="pb-3 border-b border-gray-100">
                        <h2 class="text-base font-semibold text-gray-800">Company Logo</h2>
                        <p class="mt-1 text-sm text-gray-500">Upload your company logo for invoices and reports.</p>
                    </div>

                    {{-- Logo Preview Box --}}
                    <div class="flex flex-col items-start gap-3">
                        <div class="relative w-32 h-32 shrink-0">
                            <label
                                class="flex flex-col items-center justify-center w-full h-full border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 transition-colors bg-gray-50 overflow-hidden">
                                @if ($logoPreview)
                                    <img src="{{ $logoPreview }}" class="w-full h-full object-contain p-1"
                                        alt="Logo Preview">
                                @elseif ($logo_path && file_exists(public_path($logo_path)))
                                    <img src="{{ asset($logo_path) }}?v={{ filemtime(public_path($logo_path)) }}"
                                        class="w-full h-full object-contain p-1" alt="Company Logo">
                                @else
                                    <svg class="w-7 h-7 text-gray-400 mb-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[10px] text-gray-400 mt-0.5">Upload</span>
                                @endif
                                <input type="file" wire:model="logo" class="hidden" accept=".png,.jpg,.jpeg">
                            </label>
                        </div>

                        {{-- Action Buttons — logo තියනවිට --}}
                        @if ($logoPreview || ($logo_path && file_exists(public_path($logo_path ?? ''))))
                            <div class="flex flex-row gap-3 justify-start">

                                {{-- Re-crop / Adjust --}}
                                <button type="button" wire:click="openCropModalWithExisting"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 border border-blue-300 rounded-lg hover:bg-blue-50 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>

                                {{-- Select New Logo --}}
                                <label
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-gray-600 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <input type="file" wire:model="logo" class="hidden" accept=".png,.jpg,.jpeg">
                                </label>

                                {{-- Remove --}}
                                <button type="button" wire:click="$set('showRemoveLogoConfirm', true)"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 border border-red-300 rounded-lg hover:bg-red-50 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>

                            </div>
                        @endif

                        @error('logo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload Drop Zone — logo නැතිවිට --}}
                    @if (!$logoPreview && !($logo_path && file_exists(public_path($logo_path ?? ''))))
                        <div>
                            <p class="block text-sm font-medium text-gray-700 mb-2">Upload Logo</p>

                            <div x-data="{
                                isDragging: false,
                                handleDragOver(e) { e.preventDefault();
                                    this.isDragging = true; },
                                handleDragLeave() { this.isDragging = false; },
                                handleDrop(e) {
                                    e.preventDefault();
                                    this.isDragging = false;
                                    if (e.dataTransfer.files.length > 0) {
                                        @this.set('logo', e.dataTransfer.files[0]);
                                    }
                                }
                            }" @dragover="handleDragOver" @dragleave="handleDragLeave"
                                @drop="handleDrop"
                                :class="isDragging ? 'border-blue-400 bg-blue-50' : 'border-gray-300 hover:border-gray-400'"
                                class="relative flex flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed transition-colors duration-200 px-6 py-8 text-center cursor-pointer">

                                <input type="file" wire:model="logo" accept="image/png,image/jpeg,image/jpg"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />

                                <div wire:loading.remove wire:target="logo">
                                    <svg class="w-8 h-8 text-gray-300 mx-auto" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">
                                        <span class="font-medium text-blue-600">Click to upload</span>
                                        or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5">PNG, JPG — max 2 MB</p>
                                </div>

                                <div wire:loading wire:target="logo" class="flex flex-col items-center gap-2">
                                    <svg class="animate-spin h-6 w-6 text-blue-500" fill="none"
                                        viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4" />
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                    </svg>
                                    <span class="text-xs text-gray-500">Processing...</span>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>

            {{-- Footer / Action Area --}}
            <div
                class="flex items-center justify-end border-t border-gray-100 bg-gray-50/30 px-8 py-4 rounded-b-xl gap-4">
                <button type="button" wire:click="mount"
                    class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                    Reset
                </button>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 active:scale-95 disabled:opacity-70"
                    wire:loading.attr="disabled">

                    <svg wire:loading class="h-4 w-4 animate-spin shrink-0" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4" />
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                    </svg>
                    <span wire:loading.remove>Save Company Profile</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>

        </form>
    </div>
    
    {{-- Remove Logo Confirmation Modal --}}
    @if ($showRemoveLogoConfirm)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-data x-init="$el.offsetHeight"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm" wire:click="cancelDelete">
            </div>

            {{-- Dialog --}}
            <div class="relative w-full max-w-md bg-white shadow-2xl rounded-2xl ring-1 ring-gray-200"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <div class="p-6">
                    {{-- Icon — top center --}}
                    <div class="flex justify-center mb-5">
                        <div
                            class="flex items-center justify-center rounded-full h-14 w-14 bg-red-50 ring-8 ring-red-50/60">
                            <svg class="text-red-500 h-7 w-7" fill="none" stroke="currentColor"
                                stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                    </div>

                    {{-- Text — center --}}
                    <div class="text-center">
                        <h3 class="text-base font-bold text-gray-900">Delete Logo</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-500">
                            You are about to permanently delete
                            your company logo.
                            This action <span class="font-medium text-red-600">cannot be undone</span>.
                        </p>
                    </div>

                    {{-- Divider --}}
                    <div class="my-5 border-t border-gray-100 border-dashed"></div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-center gap-3">
                        <button type="button" wire:click="$set('showRemoveLogoConfirm', false)"
                            class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 hover:border-gray-400 active:scale-95">
                            Cancel
                        </button>
                        <button wire:click="removeLogo" type="button"
                            class="flex-1 flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700 active:scale-95 disabled:opacity-60"
                            wire:loading.attr="disabled">

                            <svg wire:loading.remove wire:target="removeLogo" class="w-4 h-4 shrink-0" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span wire:loading.remove wire:target="removeLogo">Remove</span>

                            <svg wire:loading wire:target="removeLogo" class="w-4 h-4 shrink-0 animate-spin"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4" />
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                            </svg>
                            <span wire:loading wire:target="removeLogo">Removing...</span>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- ═══ Company Logo Crop Modal ═══ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

    <div x-data="{
        cropper: null,
        isApplying: false,
    
        initCropper() {
            if (this.cropper) {
                this.cropper.destroy();
                this.cropper = null;
            }
    
            const img = this.$refs.cropperImg;
            if (!img || !img.src) return;
    
            const setup = () => {
                this.cropper = new Cropper(img, {
                    aspectRatio: 600 / 240,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 1,
                    minCropBoxWidth: 50,
                    minCropBoxHeight: 50,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                    background: false,
                });
            };
    
            if (img.complete && img.naturalWidth > 0) {
                setup();
            } else {
                img.onload = setup;
                img.onerror = () => console.error('Cropper: image load failed');
            }
        },
    
        destroyCropper() {
            if (this.cropper) {
                this.cropper.destroy();
                this.cropper = null;
            }
        },
    
        zoom(ratio) { this.cropper?.zoom(ratio); },
        rotate(deg) { this.cropper?.rotate(deg); },
        reset() { this.cropper?.reset(); },
    
        async applyCrop() {
            if (!this.cropper || this.isApplying) return;
            this.isApplying = true;
    
            try {
                const cropData = this.cropper.getData(true);
                const canvas = this.cropper.getCroppedCanvas({
                    width: 600,
                    height: 240,
                    maxWidth: 4096,
                    maxHeight: 4096,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });
    
                await new Promise((resolve, reject) => {
                    canvas.toBlob((blob) => {
                        if (!blob) { reject('Canvas toBlob failed'); return; }
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            $wire.saveCroppedImage(reader.result).then(resolve).catch(reject);
                        };
                        reader.onerror = reject;
                        reader.readAsDataURL(blob);
                    }, 'image/png');
                });
            } catch (e) {
                console.error('Crop apply error:', e);
            } finally {
                this.isApplying = false;
            }
        }
    }"
        x-on:crop-modal-opened.window="
            $nextTick(() => {
                $refs.cropperImg.src = $event.detail.url;
                initCropper();
            })
        ">
        @if ($showCropModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
                x-on:keydown.escape.window="$wire.set('showCropModal', false); destroyCropper();">

                <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 p-6">

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-semibold text-gray-800">Adjust Logo</h3>
                        <button @click="destroyCropper(); $wire.set('showCropModal', false)"
                            class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Cropper Container --}}
                    <div class="relative bg-gray-100 rounded-lg overflow-hidden" style="height: 480px;">
                        <img x-ref="cropperImg" class="block max-w-full" alt="Crop preview">
                    </div>

                    {{-- Controls --}}
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex gap-2">
                            {{-- Zoom In --}}
                            <button type="button" @click="zoom(0.1)"
                                class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50" title="Zoom In">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                </svg>
                            </button>
                            {{-- Zoom Out --}}
                            <button type="button" @click="zoom(-0.1)"
                                class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50" title="Zoom Out">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0ZM13 10H7" />
                                </svg>
                            </button>
                            {{-- Rotate --}}
                            <button type="button" @click="rotate(-90)"
                                class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50" title="Rotate Left">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </button>
                            {{-- Reset --}}
                            <button type="button" @click="reset()"
                                class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-base leading-none"
                                title="Reset">↺</button>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" @click="destroyCropper(); $wire.set('showCropModal', false)"
                                class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="button" @click="applyCrop()" :disabled="isApplying"
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 disabled:opacity-60 flex items-center gap-2">
                                <svg x-show="isApplying" class="animate-spin w-4 h-4" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                                </svg>
                                <span x-text="isApplying ? 'Applying...' : 'Apply'"></span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>

</div>
