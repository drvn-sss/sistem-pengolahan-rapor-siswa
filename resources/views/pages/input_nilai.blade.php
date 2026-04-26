<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rapor — Input Nilai</title>

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
<body class="bg-gray-50" x-data="inputNilai()">

    {{-- Sidebar --}}
    @include('components.sidebar_admin')

    {{-- Main Content --}}
    <main class="ml-48 min-h-screen bg-gray-50 p-6">
        <div class="max-w-full">
            {{-- Card Container --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">

                {{-- Toolbar --}}
                <div class="p-4 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-3">

                        {{-- Left: Search Input --}}
                        <div class="w-full md:w-auto md:max-w-xs">
                            <div class="relative group">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" placeholder="Cari Siswa"
                                       class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400">
                            </div>
                        </div>

                        {{-- Right: Dropdowns & Button --}}
                        <div class="flex items-center gap-2 w-full md:w-auto flex-wrap">
                            {{-- Mapel Dropdown --}}
                            <select class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400">
                                <option>Mapel</option>
                                @foreach($mapels ?? [] as $mapel)
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                @endforeach
                                {{-- Fallback static options for preview --}}
                                <option>Matematika</option>
                                <option>Bahasa Indonesia</option>
                                <option>Bahasa Inggris</option>
                                <option>Fisika</option>
                                <option>Kimia</option>
                            </select>

                            {{-- Kelas Dropdown --}}
                            <select class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400">
                                <option>Kelas</option>
                                @foreach($kelas ?? [] as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                                {{-- Fallback static options for preview --}}
                                <option>X-IPA-1</option>
                                <option>X-IPA-2</option>
                                <option>X-IPS-1</option>
                                <option>XI-IPA-1</option>
                            </select>

                            {{-- Semester Dropdown --}}
                            <select class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400">
                                <option value="">Semester</option>
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>

                            {{-- Tahun Ajaran Dropdown (dynamic dari DB) --}}
                            <select class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white hover:border-gray-400">
                                <option value="">Tahun Ajaran</option>
                                @foreach($tahunAjarans ?? [] as $ta)
                                    <option value="{{ $ta }}">{{ $ta }}</option>
                                @endforeach
                                {{-- Fallback static options for preview --}}
                                @if(empty($tahunAjarans) || count($tahunAjarans) === 0)
                                    <option>2023/2024</option>
                                    <option>2024/2025</option>
                                    <option>2025/2026</option>
                                @endif
                            </select>

                            {{-- Simpan Draft Button --}}
                            <button class="px-4 py-2 bg-gray-700 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 active:bg-gray-900 transition-all flex items-center gap-2 whitespace-nowrap shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                </svg>
                                <span>Simpan Draft</span>
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
                                <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-1.5">
                                        <span>NO</span>
                                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/></svg>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-1.5">
                                        <span>NIS</span>
                                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/></svg>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-1.5">
                                        <span>Nama Siswa</span>
                                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/></svg>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-1.5">
                                        <span>Nilai Tugas</span>
                                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/></svg>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-1.5">
                                        <span>Ulangan Harian</span>
                                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/></svg>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-1.5">
                                        <span>UTS</span>
                                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/></svg>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-1.5">
                                        <span>UAS</span>
                                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/></svg>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-1.5">
                                        <span>Nilai Akhir</span>
                                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/></svg>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer hover:opacity-80 transition-opacity">
                                    <div class="flex items-center gap-1.5">
                                        <span>Predikat</span>
                                        <svg class="w-3 h-3 opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/></svg>
                                    </div>
                                </th>
                                <th class="px-4 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>

                        {{-- Table Body --}}
                        <tbody class="divide-y divide-gray-200">
                            <template x-for="(siswa, index) in siswaList" :key="siswa.id">
                                <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500"
                                    :class="index % 2 === 1 ? 'bg-gray-50' : 'bg-white'">

                                    {{-- NO --}}
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900" x-text="index + 1"></td>

                                    {{-- NIS --}}
                                    <td class="px-4 py-3 text-sm text-gray-700 font-semibold" x-text="siswa.nis"></td>

                                    {{-- Nama Siswa --}}
                                    <td class="px-4 py-3 text-sm text-gray-900 font-medium whitespace-nowrap" x-text="siswa.nama"></td>

                                    {{-- Nilai Tugas --}}
                                    <td class="px-4 py-3">
                                        <input
                                            type="number"
                                            min="0"
                                            max="100"
                                            x-model.number="siswa.tugas"
                                            @input="hitungNilaiAkhir(siswa)"
                                            class="w-16 px-2 py-1.5 text-sm text-center border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white hover:border-gray-400"
                                            placeholder="0"
                                        >
                                    </td>

                                    {{-- Ulangan Harian --}}
                                    <td class="px-4 py-3">
                                        <input
                                            type="number"
                                            min="0"
                                            max="100"
                                            x-model.number="siswa.ulangan"
                                            @input="hitungNilaiAkhir(siswa)"
                                            class="w-16 px-2 py-1.5 text-sm text-center border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white hover:border-gray-400"
                                            placeholder="0"
                                        >
                                    </td>

                                    {{-- UTS --}}
                                    <td class="px-4 py-3">
                                        <input
                                            type="number"
                                            min="0"
                                            max="100"
                                            x-model.number="siswa.uts"
                                            @input="hitungNilaiAkhir(siswa)"
                                            class="w-16 px-2 py-1.5 text-sm text-center border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white hover:border-gray-400"
                                            placeholder="0"
                                        >
                                    </td>

                                    {{-- UAS --}}
                                    <td class="px-4 py-3">
                                        <input
                                            type="number"
                                            min="0"
                                            max="100"
                                            x-model.number="siswa.uas"
                                            @input="hitungNilaiAkhir(siswa)"
                                            class="w-16 px-2 py-1.5 text-sm text-center border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white hover:border-gray-400"
                                            placeholder="0"
                                        >
                                    </td>

                                    {{-- Nilai Akhir (auto-calculated, read-only) --}}
                                    <td class="px-4 py-3">
                                        <div class="w-16 px-2 py-1.5 text-sm text-center border border-gray-200 rounded bg-gray-50 text-gray-700 font-semibold"
                                             x-text="siswa.nilaiAkhir !== null ? siswa.nilaiAkhir : ''">
                                        </div>
                                    </td>

                                    {{-- Predikat (auto-calculated) --}}
                                    <td class="px-4 py-3">
                                        <div class="w-12 px-2 py-1.5 text-sm text-center border border-gray-200 rounded font-bold"
                                             :class="{
                                                 'bg-green-50 text-green-700 border-green-200': siswa.predikat === 'A',
                                                 'bg-blue-50 text-blue-700 border-blue-200': siswa.predikat === 'B',
                                                 'bg-yellow-50 text-yellow-700 border-yellow-200': siswa.predikat === 'C',
                                                 'bg-red-50 text-red-700 border-red-200': siswa.predikat === 'D',
                                                 'bg-gray-50 text-gray-400 border-gray-200': !siswa.predikat
                                             }"
                                             x-text="siswa.predikat || ''">
                                        </div>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-4 py-3 text-center">
                                        <button
                                            @click="resetNilai(siswa)"
                                            title="Reset Nilai"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-red-500 hover:bg-red-600 active:bg-red-700 rounded-lg transition-all duration-150 shadow-sm hover:shadow-md">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                            <span>Reset</span>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Footer --}}
                <div class="px-6 py-4 border-t border-gray-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 bg-gray-50">
                    <span class="text-sm text-gray-600 font-medium">
                        Menampilkan <span class="text-gray-900 font-bold">1 - 20</span> Data
                    </span>

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
                        </div>

                        {{-- Next Button --}}
                        <button class="p-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        function inputNilai() {
            return {
                siswaList: [
                    { id: 1,  nis: '1809599001', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 2,  nis: '1809599002', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 3,  nis: '1809599003', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 4,  nis: '1809599004', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 5,  nis: '1809599005', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 6,  nis: '1809599006', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 7,  nis: '1809599007', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 8,  nis: '1809599008', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 9,  nis: '1809599009', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 10, nis: '1809599010', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 11, nis: '1809599011', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 12, nis: '1809599012', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 13, nis: '1809599013', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 14, nis: '1809599014', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 15, nis: '1809599015', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 16, nis: '1809599016', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 17, nis: '1809599017', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 18, nis: '1809599018', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 19, nis: '1809599019', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                    { id: 20, nis: '1809599020', nama: 'Samuel Simorangkir',   tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: '' },
                ],

                hitungNilaiAkhir(siswa) {
                    const tugas    = parseFloat(siswa.tugas)    || 0;
                    const ulangan  = parseFloat(siswa.ulangan)  || 0;
                    const uts      = parseFloat(siswa.uts)      || 0;
                    const uas      = parseFloat(siswa.uas)      || 0;

                    // Only calculate if at least one value has been entered
                    const hasValue = siswa.tugas !== null || siswa.ulangan !== null || siswa.uts !== null || siswa.uas !== null;

                    if (!hasValue) {
                        siswa.nilaiAkhir = null;
                        siswa.predikat   = '';
                        return;
                    }

                    // Bobot: Tugas 20%, Ulangan Harian 20%, UTS 30%, UAS 30%
                    const nilaiAkhir = (tugas * 0.20) + (ulangan * 0.20) + (uts * 0.30) + (uas * 0.30);
                    siswa.nilaiAkhir = Math.round(nilaiAkhir * 10) / 10;

                    // Predikat
                    if (nilaiAkhir >= 90)       siswa.predikat = 'A';
                    else if (nilaiAkhir >= 80)  siswa.predikat = 'B';
                    else if (nilaiAkhir >= 70)  siswa.predikat = 'C';
                    else                        siswa.predikat = 'D';
                },

                resetNilai(siswa) {
                    siswa.tugas      = null;
                    siswa.ulangan    = null;
                    siswa.uts        = null;
                    siswa.uas        = null;
                    siswa.nilaiAkhir = null;
                    siswa.predikat   = '';
                }
            }
        }
    </script>

</body>
</html>