@extends('layout.main')
@section('name')
    FORM NILAI
@endsection

@section('content')
   <h3>Create Nilai</h3>

   <form action="/nilai-raport/store" method="POST" class="form">
        @csrf

        <table>
            <tr class="position">
                <td>
                     <label for="siswa_id">Nama Siswa:</label>
                </td>
                <td>
                    <select name="siswa_id" id="siswa_id">
                        <option value="">Pilih Siswa</option>
                        @foreach ($siswa as $each)
                            <option value="{{ $each->id }}">{{ $each->nama_siswa }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr class="position">
                <td>Matematika</td>
                <td>
                    <input type="number" step="0.01" name="matematika" required>
                </td>
            </tr>
            <tr class="position">
                <td>Indonesia</td>
                <td>
                    <input type="number" step="0.01" name="indonesia" required>
                </td>
            </tr>
            <tr class="position">
                <td>Inggris</td>
                <td>
                    <input type="number" step="0.01" name="inggris" required>
                </td>
            </tr>
            <tr class="position">
                <td>Kejuruan</td>
                <td>
                    <input type="number" step="0.01" name="kejuruan" required>
                </td>
            </tr>
            <tr class="position">
                <td>Pilihan</td>
                <td>
                    <input type="number" step="0.01" name="pilihan" required>
                </td>
            </tr>
        </table>

        <button type="submit">Simpan</button>
    </form>
@endsection
