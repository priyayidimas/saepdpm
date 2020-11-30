@php
    $f_section = DB::table('form_section')->get();
    $alphabet = range('A','Z');
    $n = 0;
    $i = 1;
@endphp
@extends('t_index')
@section('title')
    Buat BAP
@endsection
@section('content')
<div class="container">
    <form action="{{url('insertBap')}}" method="get">
    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h3>Buat BAP Baru</h3>
            </div>
        </div>
    </div>
    <div class="mb-5" id="apa"></div>
    <div class="row mb-5">
        <div class="card w-100">
            <div class="card-body form-bap" id="">
                <div class="tab-content mb-5" style="padding: 1rem">
                    <div class="tab-pane fade in show active" id="section0" role="tabpanel">
                        <h4 class="text-center">Kegiatan</h4><hr>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">Divisi</label>
                                    <input type="text" id="form1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">Nama Kegiatan</label>
                                    <input type="text" id="form1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">Hari/ Tanggal</label>
                                    <input type="text" id="form1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">Waktu dan Tempat</label>
                                    <input type="text" id="form1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h4 class="text-center">Pengawas</h4><hr>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">NIM</label>
                                    <input type="text" id="form1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">Nama</label>
                                    <input type="text" id="form1" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                @foreach ($f_section as $s)
                @php
                    $f_format = DB::table('form_format')->where('section_id','=',$s->id)->get();
                @endphp
                    <div class="tab-pane fade in" id="section{{$s->id}}" role="tabpanel">
                        <h4 class="text-center">{{$alphabet[$n++]}}. {{$s->nama}}</h4><hr>
                        <table class="table table-bordered table-responsive-sm form-body">
                            <tr>
                                <th>Indikator</th>
                                <th style="padding-left:1rem">1</th>
                                <th style="padding-left:1rem">2</th>
                                <th style="padding-left:1rem">3</th>
                                <th style="padding-left:1rem">4</th>
                            </tr>
                        @foreach ($f_format as $f)
                            <tr>
                                <td>
                                    {{$f->variabel}} <i class="fa fa-arrow-right" aria-hidden="true"></i> {{$f->indikator}}
                                    @if ($f->keterangan != "")
                                    <a data-toggle='modal' href='#ketModal' data-keterangan= "{{$f->keterangan}}"><i class='fa fa-question-circle' aria-hidden='true'></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if ($f->n1 != 0)
                                    <fieldset class="form-check">
                                        <input class="form-check-input" name="f{{$f->id}}" type="radio" id="f{{$f->id}}o1" value="1">
                                        <label class="form-check-label" for="f{{$f->id}}o1"></label>
                                    </fieldset>
                                    @endif
                                </td>
                                <td>
                                    @if ($f->n2 != 0)
                                    <fieldset class="form-check">
                                        <input class="form-check-input" name="f{{$f->id}}" type="radio" id="f{{$f->id}}o2" value="2">
                                        <label class="form-check-label" for="f{{$f->id}}o2"></label>
                                    </fieldset>
                                    @endif
                                </td>
                                <td>
                                    @if ($f->n3 != 0)
                                    <fieldset class="form-check">
                                        <input class="form-check-input" name="f{{$f->id}}" type="radio" id="f{{$f->id}}o3" value="3">
                                        <label class="form-check-label" for="f{{$f->id}}o3"></label>
                                    </fieldset>
                                    @endif
                                </td>
                                <td>
                                    @if ($f->n4 != 0)
                                    <fieldset class="form-check">
                                        <input class="form-check-input" name="f{{$f->id}}" type="radio" id="f{{$f->id}}o4" value="4">
                                        <label class="form-check-label" for="f{{$f->id}}o4"></label>
                                    </fieldset>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                @endforeach
                    <div class="tab-pane fade in" id="section4" role="tabpanel">
                        <h4 class="text-center">{{$alphabet[$n]}}. Rincian</h4><hr>
                        <div class="md-form">
                            <textarea type="text" id="eval" name="evaluasi" class="form-control md-textarea" rows="4"></textarea>
                            <label for="eval">Evaluasi</label>
                        </div>
                        <div class="md-form">
                            <textarea type="text" id="rec" name="rekomendasi" class="form-control md-textarea" rows="4"></textarea>
                            <label for="rec">Rekomendasi</label>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
                <ul class="nav nav-tabs md-tabs nav-justified mb-5">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#section0" role="tab">1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#section1" role="tab">2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#section2" role="tab">3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#section3" role="tab">4</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#section4" role="tab">5</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </form>
</div>
<div class="modal-only">
    <div class="modal fade" id="ketModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title"><h5>Keterangan</h5></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#ketModal").on("show.bs.modal",function (e) {
                var btn = $(e.relatedTarget);
                var data = btn.data('keterangan');
                var modal = $(this);
                modal.find('.modal-body').html(data);
            });
            $(".nav-tabs a").on('show.bs.tab',function () {
                window.location.href = "#apa";
            });
        });
    </script>
@endsection
