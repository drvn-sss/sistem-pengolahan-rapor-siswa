<!DOCTYPE html>
<html lang="en" class="text-[14px]"> {{-- Mengecilkan basis ukuran font --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Pengolahan Rapor</title>
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    {{-- CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Poppins', sans-serif; }
        {{-- Mengoptimalkan tampilan pada zoom 100% agar lebih padat --}}
        input, select, button { font-size: 0.875rem !important; }
    </style>

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('toast', {
                show: false,
                message: '',
                type: 'success',
                showNotification(msg, type = 'success') {
                    this.show = true;
                    this.message = msg;
                    this.type = type;
                    setTimeout(() => { this.show = false; }, 3000);
                }
            });
        });

        window.addEventListener('notify', (e) => {
            Alpine.store('toast').showNotification(e.detail.message, e.detail.type);
        });
    </script>

    @stack('head-scripts')
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    {{-- Consistent Minimalist Dark Toast --}}
    <div x-data x-show="$store.toast.show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-10"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0 translate-x-10"
         class="fixed bottom-10 right-10 z-[100] max-w-sm w-full"
         x-cloak>
        <div class="bg-gray-900 text-white rounded-2xl p-4 flex items-center gap-4 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.4)] border border-white/10 relative overflow-hidden">
            
            {{-- Minimal Indicator Bar --}}
            <div class="absolute left-0 top-0 bottom-0 w-1.5" 
                 :class="{
                    'bg-emerald-500': $store.toast.type === 'success',
                    'bg-red-500': $store.toast.type === 'error',
                    'bg-amber-500': $store.toast.type === 'warning',
                    'bg-blue-500': $store.toast.type === 'info'
                 }"></div>

            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center">
                 <i class="fa-solid text-base" 
                    :class="{
                        'fa-check text-emerald-500': $store.toast.type === 'success',
                        'fa-xmark text-red-500': $store.toast.type === 'error',
                        'fa-triangle-exclamation text-amber-500': $store.toast.type === 'warning',
                        'fa-info text-blue-500': $store.toast.type === 'info'
                    }"></i>
            </div>

            <div class="flex-1">
                <p class="text-[9px] font-black uppercase tracking-[0.25em] text-gray-500 mb-0.5" x-text="$store.toast.type"></p>
                <p class="text-xs font-bold text-white tracking-wide" x-text="$store.toast.message"></p>
            </div>

            <button @click="$store.toast.show = false" class="w-8 h-8 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>
        </div>
    </div>

    {{-- Sidebar --}}
    <x-sidebar />

    {{-- Main Content --}}
    <main class="ml-52 min-h-screen bg-gray-50 p-4 lg:p-5"> {{-- ml disesuaikan dengan lebar sidebar baru --}}
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
