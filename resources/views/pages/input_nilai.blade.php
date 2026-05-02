@extends('layouts.app')
@section('title', 'Input Nilai')
@section('body-attrs') x-data="inputNilai()" @endsection

@section('content')
    <div class="max-w-full">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            {{-- Toolbar --}}
            <div class="p-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-3">
                    <div class="w-full md:w-auto md:max-w-xs">
                        <div class="relative group">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" placeholder="Cari Siswa" class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white hover:border-gray-400">
                        </div>
                    </div>
                    <div class="flex items-center gap-2 w-full md:w-auto flex-wrap">
                        <select class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg bg-white hover:border-gray-400">
                            <option>Mapel</option>
                            <option>Matematika</option><option>Bahasa Indonesia</option>
                        </select>
                        <select class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg bg-white hover:border-gray-400">
                            <option>Kelas</option>
                            <option>X-IPA-1</option><option>X-IPA-2</option>
                        </select>
                        <select class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg bg-white hover:border-gray-400">
                            <option value="">Semester</option><option value="ganjil">Ganjil</option><option value="genap">Genap</option>
                        </select>
                        <select class="px-3 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg bg-white hover:border-gray-400">
                            <option value="">Tahun Ajaran</option><option>2024/2025</option><option>2025/2026</option>
                        </select>
                        <button @click="toggleEdit()" :class="isEditing ? 'bg-gray-700 hover:bg-gray-800' : 'bg-blue-600 hover:bg-blue-700'" class="px-4 py-2 text-white text-sm font-semibold rounded-lg transition-all flex items-center gap-2 whitespace-nowrap shadow-sm hover:shadow-md">
                            <svg x-show="isEditing" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                            <svg x-show="!isEditing" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            <span x-text="isEditing ? 'Simpan Draft' : 'Edit Draft'"></span>
                        </button>
                    </div>
                </div>
            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-900 to-gray-800">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">NO</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">NIS</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nama Siswa</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nilai Tugas</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Ulangan Harian</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">UTS</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">UAS</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nilai Akhir</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Predikat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <template x-for="(siswa, index) in siswaList" :key="siswa.id">
                            <tr class="hover:bg-blue-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500" :class="index % 2 === 1 ? 'bg-gray-50' : 'bg-white'">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900" x-text="index + 1"></td>
                                <td class="px-4 py-3 text-sm text-gray-700 font-semibold" x-text="siswa.nis"></td>
                                <td class="px-4 py-3 text-sm text-gray-900 font-medium whitespace-nowrap" x-text="siswa.nama"></td>
                                <td class="px-4 py-3"><input type="number" min="0" max="100" x-model.number="siswa.tugas" @input="hitungNilaiAkhir(siswa)" :disabled="!isEditing" :class="!isEditing ? 'bg-gray-50 cursor-not-allowed' : (siswa.tugas < 70 && siswa.tugas !== null ? 'text-red-600 bg-red-50 border-red-200' : 'bg-white border-gray-300')" class="w-16 px-2 py-1.5 text-sm text-center border rounded focus:outline-none focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="0"></td>
                                <td class="px-4 py-3"><input type="number" min="0" max="100" x-model.number="siswa.ulangan" @input="hitungNilaiAkhir(siswa)" :disabled="!isEditing" :class="!isEditing ? 'bg-gray-50 cursor-not-allowed' : (siswa.ulangan < 70 && siswa.ulangan !== null ? 'text-red-600 bg-red-50 border-red-200' : 'bg-white border-gray-300')" class="w-16 px-2 py-1.5 text-sm text-center border rounded focus:outline-none focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="0"></td>
                                <td class="px-4 py-3"><input type="number" min="0" max="100" x-model.number="siswa.uts" @input="hitungNilaiAkhir(siswa)" :disabled="!isEditing" :class="!isEditing ? 'bg-gray-50 cursor-not-allowed' : (siswa.uts < 70 && siswa.uts !== null ? 'text-red-600 bg-red-50 border-red-200' : 'bg-white border-gray-300')" class="w-16 px-2 py-1.5 text-sm text-center border rounded focus:outline-none focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="0"></td>
                                <td class="px-4 py-3"><input type="number" min="0" max="100" x-model.number="siswa.uas" @input="hitungNilaiAkhir(siswa)" :disabled="!isEditing" :class="!isEditing ? 'bg-gray-50 cursor-not-allowed' : (siswa.uas < 70 && siswa.uas !== null ? 'text-red-600 bg-red-50 border-red-200' : 'bg-white border-gray-300')" class="w-16 px-2 py-1.5 text-sm text-center border rounded focus:outline-none focus:ring-1 focus:ring-blue-500 transition-colors" placeholder="0"></td>
                                <td class="px-4 py-3"><div class="w-16 px-2 py-1.5 text-sm text-center border border-gray-200 rounded bg-gray-50 text-gray-700 font-semibold" x-text="siswa.nilaiAkhir !== null ? siswa.nilaiAkhir : ''"></div></td>
                                <td class="px-4 py-3"><div class="w-12 px-2 py-1.5 text-sm text-center border border-gray-200 rounded font-bold" :class="{'bg-green-50 text-green-700':siswa.predikat==='A','bg-blue-50 text-blue-700':siswa.predikat==='B','bg-yellow-50 text-yellow-700':siswa.predikat==='C','bg-red-50 text-red-700':siswa.predikat==='D','bg-gray-50 text-gray-400':!siswa.predikat}" x-text="siswa.predikat || ''"></div></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <x-pagination :from="1" :to="20" :total="20" :lastPage="1" />
        </div>
    </div>
@endsection

@push('scripts')
<script>
function inputNilai() {
    return {
        siswaList: Array.from({length: 20}, (_, i) => ({
            id: i+1, nis: `180959900${String(i+1).padStart(2,'0')}`, nama: 'Samuel Simorangkir',
            tugas: null, ulangan: null, uts: null, uas: null, nilaiAkhir: null, predikat: ''
        })),
        isEditing: true,
        toggleEdit() {
            this.isEditing = !this.isEditing;
            if (!this.isEditing) {
                console.log('Draft disimpan:', this.siswaList);
            }
        },
        get stats() {
            const list = this.siswaList.filter(s => s.nilaiAkhir !== null);
            const total = list.reduce((acc, s) => acc + s.nilaiAkhir, 0);
            const avg = list.length > 0 ? (total / list.length).toFixed(1) : 0;
            const tuntas = list.filter(s => s.nilaiAkhir >= 70).length;
            const remedial = list.filter(s => s.nilaiAkhir < 70).length;
            return { rataRata: avg, tuntas: tuntas, remedial: remedial };
        },
        hitungNilaiAkhir(s) {
            const t=parseFloat(s.tugas)||0, u=parseFloat(s.ulangan)||0, m=parseFloat(s.uts)||0, a=parseFloat(s.uas)||0;
            if(s.tugas===null&&s.ulangan===null&&s.uts===null&&s.uas===null){s.nilaiAkhir=null;s.predikat='';return;}
            const na=(t*0.2)+(u*0.2)+(m*0.3)+(a*0.3);
            s.nilaiAkhir=Math.round(na*10)/10;
            s.predikat=na>=90?'A':na>=80?'B':na>=70?'C':'D';
        }
    }
}
</script>
@endpush