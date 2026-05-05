<?php

namespace App\Http\Controllers;

use App\Models\Pengampu;
use App\Models\Presensi;
use App\Models\KelasSiswa;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function showPresensi(Request $request)
    {
        $semesterAktif = Semester::where('is_aktif', true)->first();

        // Ambil data user guru yang sedang login
        $user = auth()->user();

        // Daftar pengampu untuk dropdown (Hanya milik guru yang login)
        $pengampuList = Pengampu::with(['mapel', 'kelas'])
            ->when($semesterAktif, fn($q) => $q->where('semester_id', $semesterAktif->id))
            ->where('guru_id', $user->guru_id)
            ->where('status', 'Aktif')
            ->get();

        $mapelList = $pengampuList->pluck('mapel')->unique('id')->values();
        $kelasList = $pengampuList->pluck('kelas')->unique('id')->values();

        // Pilih pengampu berdasarkan form filter
        $mapelId = $request->get('mapel_id');
        $kelasId = $request->get('kelas_id');

        if ($mapelId && $kelasId) {
            $selectedPengampu = $pengampuList->where('mapel_id', $mapelId)
                                           ->where('kelas_id', $kelasId)
                                           ->first();
        } else {
            $selectedPengampuId = $request->get('pengampu_id', $pengampuList->first()?->id);
            $selectedPengampu = $pengampuList->firstWhere('id', $selectedPengampuId);
        }

        // Proteksi Akses: Jika pengampu tidak ditemukan (mencoba akses ID guru lain), kembalikan
        if ($request->filled('pengampu_id') && !$selectedPengampu) {
            return redirect()->route('presensi')->with('error', 'Anda tidak memiliki hak akses untuk melakukan absensi pada kelas ini.');
        }

        $tanggal = $request->get('tanggal', now()->format('Y-m-d'));

        // Ambil daftar siswa + presensi
        $presensiList = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
        if ($selectedPengampu && $semesterAktif) {
            $siswaIds = KelasSiswa::where('kelas_id', $selectedPengampu->kelas_id)
                ->where('semester_id', $semesterAktif->id)
                ->pluck('siswa_id');

            $presensiMap = Presensi::where('pengampu_id', $selectedPengampu->id)
                ->where('tanggal', $tanggal)
                ->whereIn('siswa_id', $siswaIds)
                ->get()
                ->keyBy('siswa_id');

            $presensiList = \App\Models\Siswa::whereIn('id', $siswaIds)
                ->orderBy('nama_siswa')
                ->paginate(20)
                ->withQueryString();

            $presensiList->getCollection()->transform(function ($siswa) use ($presensiMap) {
                $p = $presensiMap->get($siswa->id);
                $siswa->presensi_status = $p ? $p->status : null;
                $siswa->presensi_keterangan = $p ? $p->keterangan : '';
                return $siswa;
            });
        }

        // Pre-build JSON-safe array for Alpine.js
        $presensiJsonData = collect($presensiList->items())->map(function ($s) {
            return [
                'nis' => $s->nis,
                'nama' => $s->nama_siswa,
                'status' => $s->presensi_status,
                'ket' => $s->presensi_keterangan ?? '',
            ];
        })->values();

        return view('pages.presensi', compact(
            'pengampuList',
            'mapelList',
            'kelasList',
            'selectedPengampu',
            'tanggal',
            'presensiList',
            'presensiJsonData'
        ));
    }
}
