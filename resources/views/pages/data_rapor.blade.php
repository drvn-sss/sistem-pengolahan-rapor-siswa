<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rapor — Data Rapor</title>

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

            {{-- Card Container --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                {{-- Toolbar --}}
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        {{-- Left: Search Input --}}
                        <div class="w-full md:w-auto md:max-w-xs">
                            <div class="relative group">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" placeholder="Cari nama siswa..." 
                                       class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400">
                            </div>
                        </div>
                        
                        {{-- Right: Buttons & Filters --}}
                        <div class="flex items-center gap-3 w-full md:w-auto flex-wrap">
                            <select class="flex-1 md:flex-none px-4 py-2.5 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400">
                                <option>Filter Kelas</option>
                                <option>X A</option>
                                <option>X B</option>
                                <option>XI A</option>
                                <option>XI B</option>
                                <option>XII A</option>
                                <option>XII B</option>
                            </select>

                            <button class="px-5 py-2.5 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 active:bg-red-800 transition-all flex items-center gap-2 whitespace-nowrap shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <span>Export PDF</span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Table Section --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        {{-- Table Head --}}
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
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-2">
                                        <span>Nama Siswa</span>
                                        <svg class="w-3.5 h-3.5 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-2">
                                        <span>Kelas</span>
                                        <svg class="w-3.5 h-3.5 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3z"/></svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Rata-Rata Nilai</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>

                        {{-- Table Body --}}
                        <tbody class="divide-y divide-gray-200">
                            {{-- Row 1 --}}
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">1</td>
                                <td class="px-6 py-4 text-sm text-gray-700">12001</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">Budi Santoso</td>
                                <td class="px-6 py-4 text-sm text-gray-700">X A</td>
                                <td class="px-6 py-4 text-sm text-center font-bold text-blue-600">84.3</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                        Lulus
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 flex-wrap">
                                        <button title="Lihat Detail" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg><span>Lihat</span></button>
                                        <button title="Export PDF" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg><span>Export</span></button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Row 2 --}}
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">2</td>
                                <td class="px-6 py-4 text-sm text-gray-700">12002</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-sm text-gray-700">X B</td>
                                <td class="px-6 py-4 text-sm text-center font-bold text-orange-600">75</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                        Kondisional
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 flex-wrap">
                                        <button title="Lihat Detail" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg><span>Lihat</span></button>
                                        <button title="Export PDF" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg><span>Export</span></button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Row 3 --}}
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">3</td>
                                <td class="px-6 py-4 text-sm text-gray-700">12003</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">Ahmad Riyadi</td>
                                <td class="px-6 py-4 text-sm text-gray-700">XI A</td>
                                <td class="px-6 py-4 text-sm text-center font-bold text-green-600">92.3</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                        Lulus
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 flex-wrap">
                                        <button title="Lihat Detail" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg><span>Lihat</span></button>
                                        <button title="Export PDF" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg><span>Export</span></button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Row 4 --}}
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">4</td>
                                <td class="px-6 py-4 text-sm text-gray-700">12004</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-700">XI B</td>
                                <td class="px-6 py-4 text-sm text-center font-bold text-red-600">67.7</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                        Tidak Lulus
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 flex-wrap">
                                        <button title="Lihat Detail" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg><span>Lihat</span></button>
                                        <button title="Export PDF" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg><span>Export</span></button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Row 5 --}}
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">5</td>
                                <td class="px-6 py-4 text-sm text-gray-700">12005</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">Doni Hermawan</td>
                                <td class="px-6 py-4 text-sm text-gray-700">XII A</td>
                                <td class="px-6 py-4 text-sm text-center font-bold text-green-600">86.7</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                        Lulus
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 flex-wrap">
                                        <button title="Lihat Detail" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg><span>Lihat</span></button>
                                        <button title="Export PDF" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg><span>Export</span></button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Row 6 --}}
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">6</td>
                                <td class="px-6 py-4 text-sm text-gray-700">12006</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">Evy Kartika</td>
                                <td class="px-6 py-4 text-sm text-gray-700">XII B</td>
                                <td class="px-6 py-4 text-sm text-center font-bold text-green-600">82.3</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                        Lulus
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 flex-wrap">
                                        <button title="Lihat Detail" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg><span>Lihat</span></button>
                                        <button title="Export PDF" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg><span>Export</span></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold">1</span> hingga <span class="font-semibold">6</span> dari <span class="font-semibold">120</span> hasil
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed transition-all" disabled>Sebelumnya</button>
                        <button class="px-3 py-2 text-sm font-medium bg-blue-600 text-white rounded-lg">1</button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition-all">2</button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition-all">3</button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition-all">Selanjutnya</button>
                    </div>
                </div>
            </div>

            {{-- Modal Export PDF --}}
            <div id="pdfModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900">Export Rapor ke PDF</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Format</label>
                                <select id="pdfFormat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="individual">Rapor Siswa (A4)</option>
                                    <option value="summary">Ringkasan Kelas (A4)</option>
                                    <option value="detailed">Detail Lengkap (A4)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Orientasi</label>
                                <div class="flex gap-3">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="orientation" value="portrait" checked class="w-4 h-4">
                                        <span class="text-sm">Potret</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="orientation" value="landscape" class="w-4 h-4">
                                        <span class="text-sm">Lanskap</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                        <button onclick="closePdfModal()" class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition-all">Batal</button>
                        <button onclick="exportPdf()" class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <span>Export PDF</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Modal PDF Functions
        function openPdfModal() {
            document.getElementById('pdfModal').classList.remove('hidden');
        }

        function closePdfModal() {
            document.getElementById('pdfModal').classList.add('hidden');
        }

        function exportPdf() {
            const format = document.getElementById('pdfFormat').value;
            const orientation = document.querySelector('input[name="orientation"]:checked').value;
            
            // Kirim request ke backend
            const url = `/export-rapor-pdf?format=${format}&orientation=${orientation}`;
            window.open(url, '_blank');
            
            closePdfModal();
        }

        // Event listeners untuk tombol export
        document.querySelectorAll('[title="Export PDF"]').forEach(button => {
            button.addEventListener('click', openPdfModal);
        });

        // Close modal ketika klik di luar
        document.getElementById('pdfModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePdfModal();
            }
        });
    </script>

</body>
</html>