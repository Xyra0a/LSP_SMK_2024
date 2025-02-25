@extends('layout.main')

@section('name')
    INPUT NILAI
@endsection

@section('content')
    <h3>FORM INPUT NILAI</h3>

    @if (session('error'))
        <div class="text text-danger">{{ session('error') }}</div>
    @endif

    <form action="/nilai-raport/update/{{ $nilai->id }}" method="POST" class="form">
        @csrf
        @method('PUT')

        <table>
            <tr class="position">
                <td>
                    <label for="siswa_id">Nama Siswa:</label>
                </td>
                <td>
                    <input value="{{ $siswa->id }}" type="hidden" name="siswa_id" id="siswa_id" step="0.01" required>
                    <input value="{{ $siswa->nama_siswa }}" type="text" name="nama_siswa" step="0.01" readonly>
                </td>
            </tr>


            <tr class="position">
                <td>MATEMATIKA</td>
                {{-- kalo mau make for. Id harus sama dengan for --}}
                <td>
                    <input value="{{ $nilai->matematika }}" type="number" name="matematika" step="0.01" required>
                </td>
            </tr>
            <tr class="position">
                <td>INDONESIA</td>
                {{-- kalo mau make for. Id harus sama dengan for --}}
                <td>
                    <input value="{{ $nilai->indonesia }}" type="number" name="indonesia" step="0.01" required>
                </td>
            </tr>
            <tr class="position">
                <td>INGGRIS</td>
                {{-- kalo mau make for. Id harus sama dengan for --}}
                <td>
                    <input value="{{ $nilai->inggris }}" type="number" name="inggris" step="0.01" required>
                </td>
            </tr>
            <tr class="position">
                <td>KEJURUAN</td>
                {{-- kalo mau make for. Id harus sama dengan for --}}
                <td>
                    <input value="{{ $nilai->kejuruan }}" type="number" name="kejuruan" step="0.01" required>
                </td>
            </tr>
            <tr class="position">
                <td>PILIHAN</td>
                {{-- kalo mau make for. Id harus sama dengan for --}}
                <td>
                    <input value="{{ $nilai->pilihan }}" type="number" name="pilihan" step="0.01" required>
                </td>
            </tr>
        </table>
        <button type="submit">Simpan</button>
    </form>
@endsection
