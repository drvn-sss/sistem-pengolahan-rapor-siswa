<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rapor — Ubah Kata Sandi</title>

    {{-- Google Fonts - Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Smart Rapor — Dashboard</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body class="bg-gray-50">

    {{-- Sidebar --}}
    @include('components.sidebar_admin')

    {{-- Main Content --}}
    <main class="ml-48 min-h-screen bg-gray-50 p-6">
        <div class="max-w-2xl">
            {{-- Page Header --}}
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Ubah Kata Sandi</h1>
                <p class="text-gray-600 mt-1">Perbarui kata sandi akun Anda untuk keamanan yang lebih baik</p>
            </div>

            {{-- Alert Messages --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
                    <p class="text-sm font-semibold text-red-700 mb-2">Terjadi kesalahan:</p>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-red-600">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200">
                    <p class="text-sm text-green-700 font-semibold">✓ {{ session('status') }}</p>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Kata Sandi Saat Ini --}}
                        <div>
                            <label for="current_password" class="block text-sm font-semibold text-gray-900 mb-2">
                                Kata Sandi Saat Ini
                            </label>
                            <div class="relative group">
                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    required
                                    autocomplete="current-password"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400 @error('current_password') border-red-500 @enderror"
                                    placeholder="Masukkan kata sandi saat ini"
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword('current_password')"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors"
                                >
                                    <svg id="eye-current_password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kata Sandi Baru --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">
                                Kata Sandi Baru
                            </label>
                            <div class="relative group">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400 @error('password') border-red-500 @enderror"
                                    placeholder="Masukkan kata sandi baru (minimal 8 karakter)"
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword('password')"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors"
                                >
                                    <svg id="eye-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-2">
                                <p class="text-xs text-gray-600 mb-2">Persyaratan kata sandi:</p>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li id="length-check" class="flex items-center gap-2">
                                        <span class="w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center text-[10px]">✓</span>
                                        Minimal 8 karakter
                                    </li>
                                    <li id="uppercase-check" class="flex items-center gap-2">
                                        <span class="w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center text-[10px]">✓</span>
                                        Mengandung huruf besar (A-Z)
                                    </li>
                                    <li id="lowercase-check" class="flex items-center gap-2">
                                        <span class="w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center text-[10px]">✓</span>
                                        Mengandung huruf kecil (a-z)
                                    </li>
                                    <li id="number-check" class="flex items-center gap-2">
                                        <span class="w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center text-[10px]">✓</span>
                                        Mengandung angka (0-9)
                                    </li>
                                </ul>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Kata Sandi Baru --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2">
                                Konfirmasi Kata Sandi Baru
                            </label>
                            <div class="relative group">
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400"
                                    placeholder="Konfirmasi kata sandi baru"
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword('password_confirmation')"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors"
                                >
                                    <svg id="eye-password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex gap-3 pt-6 border-t border-gray-200">
                            <button
                                type="submit"
                                class="flex-1 px-6 py-3 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <span>Simpan Kata Sandi Baru</span>
                            </button>
                            <a
                                href="{{ route('dashboard') }}"
                                class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 active:bg-gray-300 transition-all flex items-center justify-center gap-2 border border-gray-300"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info Box --}}
            <div class="mt-6 p-4 rounded-lg bg-blue-50 border border-blue-200">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-blue-900 mb-1">Tips Keamanan</p>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Gunakan kombinasi huruf besar, kecil, angka, dan simbol</li>
                            <li>• Jangan bagikan kata sandi Anda kepada siapapun</li>
                            <li>• Ubah kata sandi secara berkala untuk keamanan maksimal</li>
                            <li>• Gunakan kata sandi yang unik untuk setiap akun</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Toggle Password Visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(`eye-${fieldId}`);
            
            if (field.type === 'password') {
                field.type = 'text';
            } else {
                field.type = 'password';
            }
        }

        // Password strength checker
        const passwordField = document.getElementById('password');
        if (passwordField) {
            passwordField.addEventListener('input', function() {
                const password = this.value;
                
                // Check length
                const lengthCheck = document.getElementById('length-check');
                if (password.length >= 8) {
                    lengthCheck.querySelector('span').className = 'w-4 h-4 rounded-full bg-green-500 flex items-center justify-center text-white text-[10px]';
                } else {
                    lengthCheck.querySelector('span').className = 'w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center text-[10px]';
                }
                
                // Check uppercase
                const uppercaseCheck = document.getElementById('uppercase-check');
                if (/[A-Z]/.test(password)) {
                    uppercaseCheck.querySelector('span').className = 'w-4 h-4 rounded-full bg-green-500 flex items-center justify-center text-white text-[10px]';
                } else {
                    uppercaseCheck.querySelector('span').className = 'w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center text-[10px]';
                }
                
                // Check lowercase
                const lowercaseCheck = document.getElementById('lowercase-check');
                if (/[a-z]/.test(password)) {
                    lowercaseCheck.querySelector('span').className = 'w-4 h-4 rounded-full bg-green-500 flex items-center justify-center text-white text-[10px]';
                } else {
                    lowercaseCheck.querySelector('span').className = 'w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center text-[10px]';
                }
                
                // Check number
                const numberCheck = document.getElementById('number-check');
                if (/[0-9]/.test(password)) {
                    numberCheck.querySelector('span').className = 'w-4 h-4 rounded-full bg-green-500 flex items-center justify-center text-white text-[10px]';
                } else {
                    numberCheck.querySelector('span').className = 'w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center text-[10px]';
                }
            });
        }
    </script>

</body>
</html>
