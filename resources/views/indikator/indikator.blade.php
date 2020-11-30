@php
    $f_section = DB::table('form_section')->get();
    $alphabet = range('A','Z');
    $n = 0;
    $i = 1;
@endphp
@extends('t_index')
@section('title')
    Indikator BAP
@endsection
@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="card w-100">
            <div class="card-body">
                <h3>Indikator BAP</h3>
            </div>
        </div>
    </div>
    @foreach ($f_section as $section)
    <div class="row mb-5">
        <div class="card w-100">
            <div class="card-body">
                <h4 class="card-title">{{$section->nama}}</h4><hr>
                <button class="btn blue text-white" data-section="{{$section->id}}" data-toggle="modal" data-target="#addModal">Buat Indikator Baru</button>
                <table class="table table-hover table-responsive-sm table-bordered">
                    <thead>
                        <th>Variabel</th>
                        <th>Indikator</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach (DB::table('form_format')->where('section_id','=',$section->id)->get() as $f)
                            <tr>
                                <td>{{$f->variabel}}</td>
                                <td>{{$f->indikator}}</td>
                                <td style="{{($f->n1 == 0) ? 'background-color: #000' : ''}}"></td>
                                <td style="{{($f->n2 == 0) ? 'background-color: #000' : ''}}"></td>
                                <td style="{{($f->n3 == 0) ? 'background-color: #000' : ''}}"></td>
                                <td style="{{($f->n1 == 0) ? 'background-color: #000' : ''}}"></td>
                                <td>{!!$f->keterangan !!}</td>
                                <td style="white-space: pre"><a class="text-warning" data-toggle="modal" href="#theModal" data-token="<?php echo $f->id; ?>" style="color:white"><i class="fa fa-pencil" aria-hidden="true"></i></a>     <a class="text-danger" data-toggle="modal" data-token="<?php echo $f->id; ?>" href="#delModal"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="modal-only">
    <div class="modal fade" id="addModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('insertIndikator')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <div class="modal-title"><h5>Buat Indikator Baru</h5></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="sect_id" name="section_id">
                        <div class="md-form">
                            <input type="text" class="form-control" name="variabel">
                            <label for="nama">Variabel</label>
                        </div>
                        <div class="md-form">
                            <input type="text" class="form-control" name="indikator">
                            <label for="nama">Indikator</label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Checked = Bisa Diisi</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <fieldset class="form-check">
                                    <input type="hidden" name="val[0]" value="0">
                                    <input class="form-check-input filled-in" name="val[0]" type="checkbox" id="valo1" value="1">
                                    <label class="form-check-label" for="valo1">1</label>
                                </fieldset>
                            </div>
                            <div class="col">
                                <fieldset class="form-check">
                                    <input type="hidden" name="val[1]" value="0">
                                    <input class="form-check-input filled-in" name="val[1]" type="checkbox" id="valo2" value="1">
                                    <label class="form-check-label" for="valo2">2</label>
                                </fieldset>
                            </div>
                            <div class="col">
                                <fieldset class="form-check">
                                    <input type="hidden" name="val[2]" value="0">
                                    <input class="form-check-input filled-in" name="val[2]" type="checkbox" id="valo3" value="1">
                                    <label class="form-check-label" for="valo3">3</label>
                                </fieldset>
                            </div>
                            <div class="col">
                                <fieldset class="form-check">
                                    <input type="hidden" name="val[3]" value="0">
                                    <input class="form-check-input filled-in" name="val[3]" type="checkbox" id="valo4" value="1">
                                    <label class="form-check-label" for="valo4">4</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="md-form">
                            <textarea type="text" name="keterangan" class="form-control md-textarea" rows="4"></textarea>
                            <label for="keterangan">Keterangan</label>
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
                        <div class="modal-title"><h5>Edit Indikator</h5></div>
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
                        <div class="modal-title"><h5>Hapus Indikator</h5></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{route('deleteIndikator')}}" method="post">
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
        $("#addModal").on("show.bs.modal",function (ev) {
            var modal = $(this);
            var link = $(ev.relatedTarget);
            var sect_id = link.data('section');

            modal.find("#sect_id").val(sect_id);
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

            var url = "{{url('dashboard/indikator')}}/" + id;
            modal.find('.modal-body').load(url);
        });
    });
</script>
@endsection
