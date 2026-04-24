<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rapor — Data Presensi Kelas</title>

    {{-- Google Fonts - Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
        <div class="max-w-full">
            
            {{-- Card Container dengan Alpine.js Data --}}
            <div x-data="{ 
                    mapel: 'Matematika Wajib', 
                    kelas: 'X MIPA 1', 
                    tanggal: '2023-10-15',
                    
                    // Fungsi untuk mengubah format 'YYYY-MM-DD' menjadi '15 Oktober 2023'
                    formatTanggal() {
                        if (!this.tanggal) return '-';
                        const dateObj = new Date(this.tanggal);
                        return dateObj.toLocaleDateString('id-ID', { 
                            day: 'numeric', 
                            month: 'long', 
                            year: 'numeric' 
                        });
                    }
                }" 
                class="bg-white rounded-lg shadow-sm border border-gray-200">
                
                {{-- Toolbar Filter & Action --}}
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        
                        {{-- Left: Dropdowns & Datepicker --}}
                        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                            <div class="relative">
                                <select x-model="mapel" class="appearance-none w-40 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400 cursor-pointer">
                                    <option value="Matematika Wajib">Matematika</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    <option value="Fisika Dasar">Fisika Dasar</option>
                                    <option value="Biologi">Biologi</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-600 pointer-events-none"></i>
                            </div>
                            
                            <div class="relative">
                                <select x-model="kelas" class="appearance-none w-32 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400 cursor-pointer">
                                    <option value="X MIPA 1">X MIPA 1</option>
                                    <option value="X MIPA 2">X MIPA 2</option>
                                    <option value="XI IPS 1">XI IPS 1</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-600 pointer-events-none"></i>
                            </div>

                            {{-- Input Tanggal Fleksibel --}}
                            <div class="relative">
                                <input type="date" x-model="tanggal" class="w-40 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400 cursor-pointer">
                            </div>
                        </div>
                        
                        {{-- Right: Save Button --}}
                        <div class="w-full md:w-auto">
                            <button class="w-full md:w-auto px-5 py-2.5 bg-gray-500 text-white text-sm font-semibold rounded-md hover:bg-gray-600 active:bg-gray-700 transition-all flex items-center justify-center gap-2 shadow-sm">
                                <i class="fa-solid fa-floppy-disk text-lg"></i>
                                <span>Simpan Presensi</span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Context Header (Otomatis berubah mengikuti Input & Dropdown) --}}
                <div class="px-6 py-4 bg-blue-50/50 border-b border-gray-200">
                    <h2 class="text-base font-bold text-gray-900">Form Input Presensi Siswa</h2>
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 mt-2 text-sm">
                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="fa-solid fa-book text-blue-600 opacity-80"></i>
                            <span>Mata Pelajaran: <strong class="text-gray-900" x-text="mapel"></strong></span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="fa-solid fa-users text-blue-600 opacity-80"></i>
                            <span>Kelas: <strong class="text-gray-900" x-text="kelas"></strong></span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="fa-regular fa-calendar-days text-blue-600 opacity-80"></i>
                            <span>Tanggal: <strong class="text-gray-900" x-text="formatTanggal()"></strong></span>
                        </div>
                    </div>
                </div>

                {{-- Table Section --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        
                        {{-- Table Head: Tanpa Kolom Aksi --}}
                        <thead class="bg-gradient-to-r from-gray-900 to-gray-800 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-2">
                                        <span>NO</span>
                                        <svg class="w-3.5 h-3.5 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-2">
                                        <span>NIS</span>
                                        <svg class="w-3.5 h-3.5 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity min-w-[200px]">
                                    <div class="flex items-center gap-2">
                                        <span>NAMA SISWA</span>
                                        <svg class="w-3.5 h-3.5 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center justify-center gap-2">
                                        <span>HADIR</span>
                                        <svg class="w-3.5 h-3.5 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center justify-center gap-2">
                                        <span>TIDAK HADIR</span>
                                        <svg class="w-3.5 h-3.5 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center justify-center gap-2">
                                        <span>IZIN</span>
                                        <svg class="w-3.5 h-3.5 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity min-w-[200px]">
                                    <div class="flex items-center gap-2">
                                        <span>KETERANGAN</span>
                                        <svg class="w-3.5 h-3.5 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        {{-- Table Body (Hardcoded 10 Baris, Tanpa Kolom Aksi) --}}
                        <tbody class="divide-y divide-gray-200">
                            
                            {{-- Row 1 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-white">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">1</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599001</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Samuel Simorangkir</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_1" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_1" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_1" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4"><input type="text" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                            {{-- Row 2 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">2</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599002</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Budi Santoso</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_2" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_2" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_2" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4"><input type="text" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                            {{-- Row 3 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-white">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">3</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599003</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Citra Kirana</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_3" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_3" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_3" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4"><input type="text" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                            {{-- Row 4 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">4</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599004</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Dewi Lestari</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_4" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_4" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_4" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4"><input type="text" placeholder="Izin keluarga" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                            {{-- Row 5 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-white">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">5</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599005</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Eka Saputra</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_5" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_5" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_5" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4"><input type="text" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                            {{-- Row 6 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">6</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599006</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Fitriani</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_6" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_6" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_6" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4"><input type="text" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                            {{-- Row 7 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-white">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">7</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599007</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Gilang Ramadan</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_7" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_7" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_7" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4"><input type="text" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                            {{-- Row 8 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">8</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599008</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Hesti Purwanti</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_8" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_8" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_8" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4"><input type="text" placeholder="Sakit demam" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                            {{-- Row 9 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-white">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">9</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599009</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Ivan Gunawan</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_9" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_9" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_9" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4"><input type="text" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                            {{-- Row 10 --}}
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500 bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">10</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">1809599010</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium whitespace-nowrap">Julia Perez</td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_10" value="hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer" checked></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_10" value="tidak_hadir" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4 text-center"><input type="radio" name="status_10" value="izin" class="w-5 h-5 text-gray-900 bg-gray-100 border-gray-400 focus:ring-gray-900 focus:ring-2 cursor-pointer"></td>
                                <td class="px-6 py-4"><input type="text" class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900 shadow-sm bg-white"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                {{-- Pagination Footer Sesuai Komponen --}}
                <div class="px-6 py-4 border-t border-gray-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 bg-gray-50">
                    <span class="text-sm text-gray-600 font-medium">Menampilkan <span class="text-gray-900 font-bold">1 - 20</span> dari <span class="text-gray-900 font-bold">45</span> data</span>
                    
                    <div class="flex items-center gap-2">
                        {{-- Prev Button --}}
                        <button class="p-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        
                        {{-- Page Numbers --}}
                        <div class="flex items-center gap-1">
                            <button class="px-3 py-2 text-sm font-semibold text-white bg-gray-900 rounded-lg hover:bg-gray-800 transition-all shadow-sm">1</button>
                            <button class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all">2</button>
                            <button class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all">3</button>
                            <span class="px-2 text-gray-500">...</span>
                            <button class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all">9</button>
                        </div>
                        
                        {{-- Next Button --}}
                        <button class="p-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>