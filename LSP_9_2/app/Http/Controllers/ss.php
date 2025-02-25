public function create(){
    $walas = Walas::find(session('id'));
    $nilai = Nilai::pluck('siswa_id');

    $siswa = Siswa::where('kelas_id', $walas->kelas_id)->whereNotIn('id', $nilai)->get();
}

public function show(){
    $siswa = Siswa::with(['kelas', 'nilai'])
}
