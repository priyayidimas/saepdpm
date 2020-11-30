@php
    $kegiatan = App\Model\Kegiatan::find(4);
    $f_section = DB::table('form_section')->get();
    $alphabet = range('A','Z');
@endphp
<html>
    <head>
        <style>
            .ttd-container {
                padding-left: 40px;
            }
            .foto-ttd{
                width:150px;height:80px;
            }
            p {
                margin: 0;
            }
            table.z {
                border-collapse: collapse;
            }
            table.z tr th {
                border: 1px solid black;
            }
            table.z tr td {
                border: 1px solid black;
            }
            .val {
                font-family: Wingdings,sans-serif;
                text-align: center;
            }
            table#v tr th{
                padding-top: 20px;
                text-align: center;
                vertical-align: text-top !important;
            }
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    <body>

        <table style="text-align: left; padding-top: 15px">
            <tr>
                <th>Divisi</th>
                <th>:</th>
                <td>{{$kegiatan->divisi->nama}}</td>
            </tr>
            <tr>
                <th>Nama Kegiatan</th>
                <th>:</th>
                <td>{{$kegiatan->nama}}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>:</th>
                <td>{{$kegiatan->tanggal}}</td>
            </tr>
            <tr>
                <th>Waktu dan Tempat</th>
                <th>:</th>
                <td>{{$kegiatan->keterangan}}</td>
            </tr>
        </table>
        @foreach ($f_section as $s)
        @php
            $form = DB::table('form_format')->where("section_id",'=',$s->id)->get();
            $i = 1;
        @endphp
        <h3>{{$alphabet[$s->id-1]}}. {{$s->nama}}</h3>
        <table style="width:100%" class="z">
            <tr style="text-align:center">
                <th rowspan="2">No</th>
                <th rowspan="2">Variabel</th>
                <th rowspan="2">Indikator</th>
                <th colspan="4">Nilai</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr style="text-align:center">
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
            </tr>
            @foreach ($form as $f)
            @php
                $nilaiModel = App\Model\Nilai::where('form_id',$f->id)
                                        ->where('kegiatan_id',$kegiatan->id)->first();
                $nilai = ($nilaiModel->nilai) ?? 0;
                echo $nilai;
            @endphp
            <tr>
                <td style="width: 6.25%; text-align:center">{{$i++}}</td>
                <td style="width: 18.75%; padding-left:10px">{{$f->variabel}}</td>
                <td style="width: 25%; padding-left:10px">{{$f->indikator}}</td>
                <td class="val" style="width: 6.25%; {{$a = ($f->n1 == 0) ? 'background-color: #000' : ''}}">{!! ($nilai == 1) ? "4" : "" !!}</td>
                <td class="val" style="width: 6.25%; {{$a = ($f->n2 == 0) ? 'background-color: #000' : ''}}">{!! ($nilai == 2) ? "4" : "" !!}</td>
                <td class="val" style="width: 6.25%; {{$a = ($f->n3 == 0) ? 'background-color: #000' : ''}}">{!! ($nilai == 3) ? "4" : "" !!}</td>
                <td class="val" style="width: 6.25%; {{$a = ($f->n4 == 0) ? 'background-color: #000' : ''}}">{!! ($nilai == 4) ? "4" : "" !!}</td>
                <td style="width: 25%">{!!$f->keterangan!!}</td>
            </tr>
            @endforeach
        </table>
        @endforeach
        <div class="page-break"></div>
        <h3>D. Rincian</h3>
        <table class="z" id="v" style="width:100%">
            <tr>
                <th style="width:25%">Evaluasi</th>
                <td style="width:50%">
                    {!! $kegiatan->evaluasi !!}
                </td>
                <th rowspan="2" style="width:25%">
                    <b>Skor</b>
                    <h1>108/108</h1>
                    <b>Nilai Kegiatan</b>
                    <h1>100%</h1>
                </th>
            </tr>
            <tr>
                <th style="width:25%">Rekomendasi</th>
                <td style="width:50%">
                    {!! $kegiatan->rekomendasi !!}
                </td>
            </tr>
        </table>
        <br>
        <table style="width:100%">
            <tr>
                <td style="width:30%"></td>
                <td style="width:40%"></td>
                <td style="width:30%">
                    <b>Bandung, 10 Oktober 2019 </b>
                </td>
            </tr>
            <tr>
                <td style="width:30%"></td>
                <td style="width:40%" class="ttd-container">
                    <b>Ketua DPM</b>
                </td>
                <td style="width:30%">
                    <b>Pengawas</b>
                </td>
            </tr>
            <tr>
                <td style="width:30%"></td>
                <td style="width:40%">
                </td>
                <td style="width:30%">
                </td>
            </tr>
            <tr>
                <td style="width:30%"></td>
                <td style="width:40%">
                    <img src="{{url('assets/img/cap.png')}}" alt="" style="height:120px; z-index:20; position:absolute">
                    <img class="foto-ttd ttd-container" src="{{url('assets/img/ttd-hilmi.png')}}" alt="" style="position:relative;">
                </td>
                <td style="width:30%">
                    <img class="foto-ttd" src="{{$kegiatan->pengawas_ttd}}" alt="">
                </td>
            </tr>
            <tr>
                <td style="width:30%"></td>
                <td style="width:40%" class="ttd-container">
                    {{-- Max Char 25 --}}
                    <b>Hilmi Adlannaafi</b>
                </td>
                <td style="width:30%">
                    {{-- Max 25 Char Aja --}}
                    <b>Mulky Mursyidi Asmilan</b>
                </td>
            </tr>
            <tr>
                <td style="width:30%"></td>
                <td style="width:40%" class="ttd-container">
                    <b>NIM. 1705007</b>
                </td>
                <td style="width:30%">
                    <b>NIM. 1806500</b>
                </td>
            </tr>
        </table>
    </body>
</html>
