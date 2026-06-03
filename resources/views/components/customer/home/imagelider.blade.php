<div x-data="{
    activeSlide: 1,
    slides: [
        { id: 1, tag: 'Apple Products', subTag: '100% Autehntic', title: 'Latest Apple Products', url: 'https://images.unsplash.com/photo-1707485122968-56916bd2c464?q=80&w=774&auto=format&fit=crop' },
        { id: 2, tag: 'Accessories', subTag: 'Cases & Covers', title: 'Protect Your Devices', url: 'https://images.unsplash.com/photo-1777539995571-be2f136738d1?q=80&w=870&auto=format&fit=crop' },
        { id: 3, tag: 'Tablets', subTag: 'iPad & Surface', title: 'Portable Productivity', url: 'https://images.unsplash.com/photo-1587831990711-23ca6441447b?q=80&w=1031&auto=format&fit=crop' },
        { id: 4, tag: 'Wearables', subTag: 'Apple Watch & AirPods', title: 'Stay Connected', url: 'https://images.unsplash.com/photo-1598382143506-2ac06c28d203?q=80&w=870&auto=format&fit=crop' }
    ],
    timer: null,
    {{-- Auto Scroll Start --}}
    start() {
        this.timer = setInterval(() => {
            this.next();
        }, 5000);
    },
    {{-- Auto Scroll Stop --}}
    stop() {
        clearInterval(this.timer);
        this.timer = null;
    },
    {{-- Auto execute start() --}}
    init() {
        this.start();
    },

    next() { this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1 },
    prev() { this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1 }
}" @mouseenter="stop()" @mouseleave="start()"
    class=" relative w-full overflow-hidden shadow-lg mb-8 z-0">

    <div class="relative h-64 w-full md:h-166 bg-gray-100">
        <template x-for="slide in slides" :key="slide.id">
            <div x-show="activeSlide === slide.id" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100" class="absolute inset-0">
                <img :src="slide.url" alt="Carousel Image" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/20"></div>
                {{-- Slide Content --}}
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                    <h2 class="text-sm text-white uppercase tracking-wide" x-text="slide.tag"></h2>
                    <p class="text-lg text-white mt-2" x-text="slide.subTag"></p>
                    <h1 class="text-3xl md:text-5xl font-bold text-white mt-4" x-text="slide.title"></h1>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-4">
                        Shop Now
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-5 inline-block ml-1">
                            <path fill-rule="evenodd"
                                d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </template>
    </div>
    <button @click="prev()"
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow hover:bg-white transition z-10">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
            stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
    </button>

    <button @click="next()"
        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 p-2 rounded-full shadow hover:bg-white transition z-10">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
            stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
</div>
