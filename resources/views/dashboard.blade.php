@extends('t_index')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="card w-100">
            <div class="card-body">
                <h3>BAP Paling Baru</h3>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="card w-100">
            <div class="card-body">
                <h4 class="card-title">BAP Yang Sudah</h4><hr>
                <table class="table table-hover table-responsive-sm table-bordered">
                    <thead>
                        <th>Divisi</th>
                        <th>Nama Proker</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @forelse ($kegiatan as $proker)
                        <tr>
                            <td>{{$proker->divisi->nama}}</td>
                            <td>{{$proker->nama}}</td>
                            <td>{{$proker->tanggal }}</td>
                            <td>{{$proker->keterangan }}</td>
                            <td style="white-space: pre"><a class="text-success" href="{{route('bapProker',$proker->id)}}"><i class="fas fa-check-square"></i></a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Data Belum Ada</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
