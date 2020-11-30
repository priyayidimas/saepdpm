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
@section('head')
    <style>
        .signature-wrapper {
            position: relative;
            width: 400px;
            height: 200px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .signature-pad {
            position: absolute;
            left: 0;
            top: 0;
            width:400px;
            height:200px;
            background-color: white;
            border: 2px solid black;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <form action="{{route('updateBAPProker')}}" method="POST" id="formBap">
    @method("PUT")
    @csrf
    <input type="hidden" name="kegiatan_id" value="{{$kegiatan->id}}">
    <div class="row">
        <div class="card w-100 nearly-white-1">
            <div class="card-body">
                <h3>Buat BAP Baru</h3>
            </div>
        </div>
    </div>
    <div class="mb-5" id="apa"></div>
    <div class="row mb-5">
        <div class="card w-100 nearly-white-1">
            <div class="card-body form-bap" id="">
                <div class="tab-content mb-5" style="padding: 1rem">
                    <div class="tab-pane fade in show active" id="section0" role="tabpanel">
                        <h4 class="text-center">Kegiatan</h4><hr>
                        <div class="row mb-3">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="">Divisi</label>
                                    <select name="divisi_id" id="" class="form-control browser-default" required>
                                        <option value="{{$kegiatan->divisi->id}}">{{$kegiatan->divisi->nama}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">Nama Kegiatan</label>
                                    <input type="text" name="kegiatan" id="form1" class="form-control" value="{{$kegiatan->nama}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p for="form1" class="">Tanggal Proker (YYYY-MM-DD)</p>
                                <div class="form">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="md-form">
                                                <input placeholder=" " type="text" name="tanggal" id="date-picker-example" class="form-control datepicker" value="{{$kegiatan->tanggal}}" required>
                                                <label for="date-picker-example">Pilih Tanggal</label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <div class="md-form">
                                                <input placeholder=" " type="text" id="input_starttime" class="form-control timepicker">
                                                <label for="input_starttime">Waktu</label>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="" cols="30" rows="4">{{$kegiatan->keterangan}}</textarea>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-center">Pengawas</h4><hr>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">NIM</label>
                                    <input type="text" name="pengawas_nim" id="form1" class="form-control" value="{{$kegiatan->pengawas_nim}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form">
                                    <label for="form1" class="">Nama</label>
                                    <input type="text" name="pengawas_nama" id="form1" class="form-control" value="{{$kegiatan->pengawas_nama}}">
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
                                <th>Variabel</th>
                                <th>Indikator</th>
                                <th style="padding-left:1rem">1</th>
                                <th style="padding-left:1rem">2</th>
                                <th style="padding-left:1rem">3</th>
                                <th style="padding-left:1rem">4</th>
                            </tr>
                        @foreach ($f_format as $f)
                        @php
                            $valueModel = App\Model\Nilai::where('form_id',$f->id)
                                                    ->where('kegiatan_id',$kegiatan->id)->first();
                            $value = ($valueModel->nilai) ?? 0;
                        @endphp
                            <tr>
                                <td>{{$f->variabel}}</td>
                                <td>
                                    {{$f->indikator}}
                                    @if ($f->keterangan != "")
                                    <a data-toggle='modal' href='#ketModal' data-keterangan="{{$f->keterangan}}"><i class='fa fa-question-circle' aria-hidden='true'></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if ($f->n1 != 0)
                                    <fieldset class="form-check">
                                        <input class="form-check-input" name="form[{{$f->id}}]" type="radio" id="form{{$f->id}}o1" value="1" {{($value == 1)?"checked":""}}>
                                        <label class="form-check-label" for="form{{$f->id}}o1"></label>
                                    </fieldset>
                                    @endif
                                </td>
                                <td>
                                    @if ($f->n2 != 0)
                                    <fieldset class="form-check">
                                        <input class="form-check-input" name="form[{{$f->id}}]" type="radio" id="form{{$f->id}}o2" value="2" {{($value == 2)?"checked":""}}>
                                        <label class="form-check-label" for="form{{$f->id}}o2"></label>
                                    </fieldset>
                                    @endif
                                </td>
                                <td>
                                    @if ($f->n3 != 0)
                                    <fieldset class="form-check">
                                        <input class="form-check-input" name="form[{{$f->id}}]" type="radio" id="form{{$f->id}}o3" value="3" {{($value == 3)?"checked":""}}>
                                        <label class="form-check-label" for="form{{$f->id}}o3"></label>
                                    </fieldset>
                                    @endif
                                </td>
                                <td>
                                    @if ($f->n4 != 0)
                                    <fieldset class="form-check">
                                        <input class="form-check-input" name="form[{{$f->id}}]" type="radio" id="form{{$f->id}}o4" value="4" {{($value == 4)?"checked":""}}>
                                        <label class="form-check-label" for="form{{$f->id}}o4"></label>
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
                            <textarea type="text" id="eval" name="evaluasi" class="form-control md-textarea" rows="4">{!! str_replace("<br />","&#13;",$kegiatan->evaluasi) !!}</textarea>
                            <label for="eval">Evaluasi</label>
                        </div>
                        <div class="md-form">
                            <textarea type="text" id="rec" name="rekomendasi" class="form-control md-textarea" rows="4">{!! str_replace("<br />","&#13;",$kegiatan->rekomendasi) !!}</textarea>
                            <label for="rec">Rekomendasi</label>
                        </div>
                        <button data-toggle="modal" data-target="#signModal" type="button" class="btn btn-default">Submit</button>
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
    <div class="modal fade" id="signModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title"><h5>Tanda Tangan Pengawas</h5></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h5>Silahkan Tanda Tangan Di bawah ini</h5>
                    <div class="signature">
                        <div class="signature-wrapper">
                            <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                        </div>
                        <button type="button" class="btn btn-sm btn-info" id="draw">Draw</button>
                        <button type="button" class="btn btn-sm btn-warning" id="erase">Erase</button>
                        <button type="button" class="btn btn-sm btn-danger" id="clear">Clear</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" id="submitBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{url('assets/js/signature_pad.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.datepicker').pickadate({
                format: 'yyyy-mm-dd'
            });
            $('.timepicker').pickatime({});
            $("#ketModal").on("show.bs.modal",function (e) {
                var btn = $(e.relatedTarget);
                var data = btn.data('keterangan');
                var modal = $(this);
                modal.find('.modal-body').html(data);
            });
            $(".nav-tabs a").on('show.bs.tab',function () {
                window.location.href = "#apa";
            });


            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas, {
                minWidth: 1,
                maxWidth: 5,
                backgroundColor: 'rgba(255, 255, 255, 0)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
            });

            $("#submitBtn").on("click", function () {
                if (signaturePad.isEmpty()) {
                    return alert("Lengkapi Tanda Tangan Sebelum Melanjutkan");
                }

                var data = signaturePad.toDataURL('image/png');
                $("<input>").attr({
                    name: "pengawas_ttd",
                    type: "hidden",
                    value: data
                }).appendTo("#formBap");

                $("#formBap").submit();
            });

            document.getElementById('clear').addEventListener('click', function () {
                signaturePad.clear();
            });

            document.getElementById('draw').addEventListener('click', function () {
                var ctx = canvas.getContext('2d');
                console.log(ctx.globalCompositeOperation);
                ctx.globalCompositeOperation = 'source-over'; // default value
            });

            document.getElementById('erase').addEventListener('click', function () {
                var ctx = canvas.getContext('2d');
                ctx.globalCompositeOperation = 'destination-out';
            });
        });
    </script>
@endsection
