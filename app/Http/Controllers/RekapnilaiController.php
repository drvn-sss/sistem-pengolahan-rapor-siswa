<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Semester;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapNilaiController extends Controller
{
    public function showRekapNilai(Request $request)
    {
        $semesterAktif = Semester::where('is_aktif', true)->first();

        // Menggunakan Query Builder dari KelasSiswa agar semua siswa muncul meskipun belum ada nilai
        $query = KelasSiswa::query()
            ->select(
                'kelas_siswa.id as kelas_siswa_id',
                'pengampu.id as pengampu_id',
                'kelas_siswa.siswa_id',
                'pengampu.kkm',
                'mapel.nama_mapel',
                'kelas.nama_kelas'
            )
            ->join('pengampu', function($join) {
                $join->on('kelas_siswa.kelas_id', '=', 'pengampu.kelas_id')
                     ->on('kelas_siswa.semester_id', '=', 'pengampu.semester_id');
            })
            ->join('mapel', 'pengampu.mapel_id', '=', 'mapel.id')
            ->join('kelas', 'pengampu.kelas_id', '=', 'kelas.id')
            ->leftJoin('nilai', function($join) {
                $join->on('kelas_siswa.id', '=', 'nilai.kelas_siswa_id')
                     ->on('pengampu.id', '=', 'nilai.pengampu_id');
            })
            // Pivot vertikal ke horizontal - Menggunakan kunci yang konsisten dengan InputNilaiController
            ->selectRaw("MAX(CASE WHEN nilai.jenis_nilai = 'p_tugas' THEN nilai.skor END) as tugas")
            ->selectRaw("MAX(CASE WHEN nilai.jenis_nilai = 'p_uts' THEN nilai.skor END) as uts")
            ->selectRaw("MAX(CASE WHEN nilai.jenis_nilai = 'p_uas' THEN nilai.skor END) as uas")
            ->selectRaw("MAX(CASE WHEN nilai.jenis_nilai = 'catatan' THEN nilai.catatan_guru END) as catatan_guru")
            ->selectRaw("ROUND(AVG(CASE WHEN nilai.jenis_nilai IN ('p_tugas', 'p_uh', 'p_uts', 'p_uas') THEN nilai.skor END), 2) as rata_pengetahuan")
            ->groupBy('kelas_siswa.id', 'pengampu.id', 'kelas_siswa.siswa_id', 'pengampu.kkm', 'mapel.nama_mapel', 'kelas.nama_kelas');

        // Filter berdasarkan Semester Aktif
        if ($semesterAktif) {
            $query->where('kelas_siswa.semester_id', $semesterAktif->id);
        }

        // Filter Pencarian & Dropdown
        if ($request->search) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama_siswa', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->kelas_id) {
            $query->where('pengampu.kelas_id', $request->kelas_id);
        }

        if ($request->mapel_id) {
            $query->where('pengampu.mapel_id', $request->mapel_id);
        }

        $nilaiData = $query->with(['siswa'])
            ->paginate(20)
            ->withQueryString();

        $kelasList = Kelas::orderBy('nama_kelas')->get();
        $mapelList = Mapel::where('status', 'Aktif')->orderBy('nama_mapel')->get();

        return view('pages.rekap_nilai', compact('nilaiData', 'kelasList', 'mapelList'));
    }
}