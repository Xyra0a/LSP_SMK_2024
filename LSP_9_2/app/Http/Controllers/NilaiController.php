<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Walas;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Ssi;

class NilaiController extends Controller
{

    public function gradeMapel($nilai)
    {
        if($nilai >= 90){
            return 'A';
        }elseif($nilai >= 80){
            return 'B';
        }elseif($nilai >= 70){
            return 'C';
        }elseif($nilai >= 60){
            return 'D';
        }else{
            return 'E';
        }
    }



    public function index()
    {

        $walas = Walas::find(session('id'));

        if (!$walas) {
            return back()->with('error', 'Data wali kelas tidak ditemukan');
        }
        $data_nilai = Nilai::whereHas('siswa', function($query) use ($walas){
            $query->where('kelas_id', $walas->kelas_id);
        })->with('siswa')->get();
        
        $kelas = Kelas::where('id', session('id'))->first();

        return view('nilai.index', compact('data_nilai', 'kelas'));
    }

    public function create()
    {
        $walas = Walas::find(session('id'));
        $nilai = Nilai::pluck('siswa_id');
        $siswa = Siswa::where('kelas_id', $walas->kelas_id)->whereNotIn('id', $nilai)->get();

        return view('nilai.create', compact('siswa'));
    }

    public function store(Request $request)
    {
       $data_nilai = $request->validate([
            'siswa_id' => 'required',
            'matematika' => 'required',
            'indonesia' => 'required',
            'inggris' => 'required',
            'kejuruan' => 'required',
            'pilihan' => 'required',
       ]);

       $data_nilai['walas_id'] = session('id');
       $data_nilai['rata_rata'] = round((
            $data_nilai['matematika'] +
            $data_nilai['indonesia'] +
            $data_nilai['inggris'] +
            $data_nilai['kejuruan'] +
            $data_nilai['pilihan']
       ) /5);

       $cek_nilai = Nilai::where('siswa_id', $request->siswa_id)->first();

       if(!$cek_nilai){
            return back()->withErrors('error', 'Nilai udah ada');
       }else{
            Nilai::create($data_nilai);
            return redirect()->route('guruShow')->with('success', 'Data berhasil ditambahkan');
       }
    }

    public function show()
    {
        $siswa = Siswa::with(['kelas', 'nilai'])->find(session('id'));
        $nilai = optional($siswa?->nilai)->first();
        $walas = Nilai::with('walas')->first();

        $mapel = ['matematika', 'indonesia', 'inggris', 'kejuruan', 'pilihan', 'rata_rata'];
        $data_nilai = collect($mapel)->mapWithKeys(fn($m) => [
            $m => [
                'nilai' => data_get($nilai, $m, 'Data tidak ditemukan'),
                'grade' => $nilai ? $this->gradeMapel(data_get($nilai, $m)) : 'N/A',
            ],
        ])->toArray();

        return view('nilai.show', compact('siswa', 'data_nilai', 'walas'));

    }

    public function showNilai($id)
    {
        $nilai = Nilai::with('siswa')->find($id);
        $siswa = $nilai->siswa;
        $walas_id = $nilai->walas_id;
        $walas = Walas::find($walas_id);

        $mapel = ['matematika', 'indonesia', 'inggris', 'kejuruan', 'pilihan', 'rata_rata'];
        $data_nilai = [];

        foreach ($mapel as $m) {
            $data_nilai[$m] = [
                'nilai' => data_get($nilai, $m, 'Data tidak ditemukan'),
                'grade' => $nilai ? $this->gradeMapel(data_get($nilai, $m)) : 'N/A',
            ];
        }
            return view('nilai.show', compact('siswa', 'data_nilai', 'walas'));    }


    public function edit(Nilai $nilai)
    {
        $walas = Walas::find(session('id'));
        $siswa = Siswa::where('id', $nilai->siswa_id)->first();

        return view('nilai.edit', compact('nilai', 'siswa', 'walas'));
    }


    public function update(Request $request, Nilai $nilai)
    {
        $data_nilai = $request->validate([
            'siswa_id' => ['required'],
            'matematika' => ['required'],
            'indonesia' => ['required'],
            'inggris' => ['required'],
            'kejuruan' => ['required'],
            'pilihan' => ['required']
        ]);
        $data_nilai['walas_id'] = session('id');
        $data_nilai['rata_rata'] = round((
            $data_nilai['matematika'] +
            $data_nilai['indonesia'] +
            $data_nilai['inggris'] +
            $data_nilai['kejuruan'] +
            $data_nilai['pilihan']
        ) / 5);

            $nilai->update($data_nilai);
            return redirect()->route('guruShow')->with('success', 'Data nilai berhasil diupdate');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('guruShow')->with('success', 'Data berhasil dihapus');
    }
}

/*
  $walas = Walas::find(session('id'));

        if(!$walas){
            return back()->withErrors('error', 'Walas tidak ditemukan');
        }

        $data_nilai = Nilai::whereHas('siswa', function($query) use ($walas){
            $query->where('kelas_id', $walas->kelas_id);
        })->with('siswa')->get();

        // $kelas = Kelas::where('id', session('id'))->first();

        return view('nilai.index', compact('data_nilai'));
*/

/*
 // Mencari data walas (wali kelas) berdasarkan ID dari session
        $walas = Walas::find(session('id'));

        // Pengecekan jika data walas tidak ditemukan
        if(!$walas){
            // Kembali ke halaman sebelumnya dengan pesan error
            return back()->with('error', 'Data walas tidak ditemukan');
        }

        // Mengambil data nilai dengan relasi:
        // - Filter hanya nilai siswa yang berada di kelas wali kelas tersebut
        // - Menggunakan eager loading untuk mengambil data siswa sekaligus
        $data_nilai = Nilai::whereHas('siswa', function($query) use ($walas){
            $query->where('kelas_id', $walas->kelas_id);
        })->with('siswa')->get();

        // Mengambil data kelas berdasarkan ID kelas wali kelas
        $kelas = Kelas::where('id', $walas->kelas_id)->first();

        // Menampilkan view 'nilai.index' dengan membawa data:
        // 1. data_nilai: daftar nilai siswa di kelas tersebut
        // 2. kelas: informasi kelas
        return view('nilai.index', compact(['data_nilai', 'kelas']));
*/
