@extends('t_index')
@section('title')
    Program Kerja BEM
@endsection
@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="card w-100">
            <div class="card-body">
                <h3>Program Kerja BEM</h3>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="card w-100">
            <div class="card-body">
                <h4 class="card-title">Daftar Program Kerja BEM</h4><hr>
                <button class="btn blue text-white mb-4" data-toggle="modal" data-target="#addModal">Tambah Proker Baru</button>
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
                            <td style="white-space: pre"><a class="text-success" href="{{route('bapProker',$proker->id)}}"><i class="fas fa-check-square"></i></a>     <a class="text-warning" data-toggle="modal" href="#theModal" data-token="<?php echo $proker->id; ?>" style="color:white"><i class="fa fa-pencil" aria-hidden="true"></i></a>     <a class="text-danger" data-toggle="modal" data-token="<?php echo $proker->id; ?>" href="#delModal"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
<div class="modal-only">
    <div class="modal fade" id="addModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('insertKegiatan')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <div class="modal-title"><h5>Buat Indikator Baru</h5></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form">
                                    <label for="">Divisi</label>
                                    <select name="divisi_id" id="" class="form-control browser-default" required>
                                        @foreach ($divisi as $div)
                                        <option value="{{$div->id}}">{{$div->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form">
                                    <label for="form1" class="">Nama Kegiatan</label>
                                    <input type="text" name="nama" id="form1" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p for="form1" class="">Tanggal Proker (YYYY-MM-DD)</p>
                                <div class="form">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="md-form">
                                                <input placeholder=" " type="text" name="tanggal" id="date-picker-example" class="form-control datepicker" required>
                                                <label for="date-picker-example">Pilih Tanggal</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form">
                                    <label for="form1" class="">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="theModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title"><h5>Edit Proker</h5></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title"><h5>Hapus Proker</h5></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{route('deleteKegiatan')}}" method="post">
                    <div class="modal-body">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" id="delId">
                        <p>Yakin Mau Hapus Ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.datepicker').pickadate({
            format: 'yyyy-mm-dd'
        });
        $("#delModal").on("show.bs.modal",function (ev) {
            var modal = $(this);
            var link = $(ev.relatedTarget);
            var id = link.data('token');

            modal.find("#delId").val(id);
        });
        $("#theModal").on("show.bs.modal",function (ev) {
            var modal = $(this);
            var link = $(ev.relatedTarget);
            var id = link.data('token');

            var url = "{{url('dashboard/kegiatan')}}/" + id;
            modal.find('.modal-body').load(url);
        });
    });
</script>
@endsection
