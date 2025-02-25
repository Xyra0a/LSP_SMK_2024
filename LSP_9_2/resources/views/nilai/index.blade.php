@extends('layout.main')

@section('name')
    REKAP NILAI
@endsection

@section('content')
    <center>
        <p align="right">
            <a href="/nilai-raport/create"><button class="add-button">INPUT NILAI</button></a>
        </p>

        <table class="table-show">
            <thead>
                <tr>
                    <th class="border-head" rowspan="2">NO</th>
                    <th class="border-head" rowspan="2">NIS</th>
                    <th class="border-head" rowspan="2">NAMA</th>
                    <th class="border-head" colspan="6">NILAI</th>
                    <th class="border-head" rowspan="3" colspan="2">ACTION</th>
                </tr>

                <tr>
                    <th class="border-head">MATEMATIKA</th>
                    <th class="border-head">INDONESIA</th>
                    <th class="border-head">INGGRIS</th>
                    <th class="border-head">KEJURUAN</th>
                    <th class="border-head">PILIHAN</th>
                    <th class="border-head">RATA-RATA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_nilai as $data)
                    <tr>
                        <td class="border-data">{{ $loop->iteration }}</td>
                        <td class="border-data">{{ $data->siswa->nis }}</td>
                        <td class="border-data">{{ $data->siswa->nama_siswa }}</td>
                        <td class="border-data">{{ $data->matematika }}</td>
                        <td class="border-data">{{ $data->indonesia }}</td>
                        <td class="border-data">{{ $data->inggris }}</td>
                        <td class="border-data">{{ $data->kejuruan }}</td>
                        <td class="border-data">{{ $data->pilihan }}</td>
                        <td class="border-data">{{ $data->rata_rata }}</td>
                        <td class="border-data" style="text-align: center">
                            <div class="action">
                                <a href="/nilai-raport/show/{{ $data->id }}"><button class="index-button">VIEW</button></a>
                                <a href="/nilai-raport/edit/{{ $data->id }}"><button class="index-button">EDIT</button></a>
                                <a href="/nilai-raport/destroy/{{ $data->id }}"><button class="index-button">DELETE</button></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center>
@endsection
