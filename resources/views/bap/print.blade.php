@php
    $f_section = DB::table('form_section')->get();
    $alphabet = range('A','Z');
@endphp
<html>
    <head>
        <style>
            @font-face {font-family: "ZapfDingbats"; src: url("//db.onlinewebfonts.com/t/7a54a3ab6d44bff09dfc26ef56ec2f45.eot"); src: url("//db.onlinewebfonts.com/t/7a54a3ab6d44bff09dfc26ef56ec2f45.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/7a54a3ab6d44bff09dfc26ef56ec2f45.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/7a54a3ab6d44bff09dfc26ef56ec2f45.woff") format("woff"), url("//db.onlinewebfonts.com/t/7a54a3ab6d44bff09dfc26ef56ec2f45.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/7a54a3ab6d44bff09dfc26ef56ec2f45.svg#ZapfDingbats") format("svg"); }
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
                font-family: ZapfDingbats;
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
        <table>
            <tr>
                <th>
                    <img src="assets/img/Kop.jpg" alt="" srcset="" width="100%">
                </th>
            </tr>
        </table>
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
                <td>{{Carbon\Carbon::parse($kegiatan->tanggal)->formatLocalized("%d %B %Y")}}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
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
                    <h1>{{$skor = $kegiatan->nilai()->sum('nilai')}}/{{$total = $kegiatan->nilai()->count()*4}}</h1>
                    <b>Nilai Kegiatan</b>
                    <h1>{{round(($skor/$total*100),2)}}%</h1>
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
                    <b>Bandung, {{ Carbon\Carbon::parse($kegiatan->updated_at)->formatLocalized("%d %B %Y") }}</b>
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
                    <img src="assets/img/cap.png" alt="" style="height:120px; z-index:20; position:absolute">
                    <img class="foto-ttd ttd-container" src="assets/img/ttd-hilmi.png" alt="" style="position:relative;">
                </td>
                <td style="width:30%">
                    <img class="foto-ttd" src="{{$kegiatan->pengawas_ttd}}" alt="">
                </td>
            </tr>
            <tr>
                <td style="width:30%"></td>
                <td style="width:40%" class="ttd-container">
                    <b>Hilmi Adlannaafi</b>
                </td>
                <td style="width:30%">
                    <b>{!! $kegiatan->pengawas_nama !!}</b>
                </td>
            </tr>
            <tr>
                <td style="width:30%"></td>
                <td style="width:40%" class="ttd-container">
                    <b>NIM. 1705007</b>
                </td>
                <td style="width:30%">
                    <b>NIM. {!! $kegiatan->pengawas_nim !!}</b>
                </td>
            </tr>
        </table>
    </body>
</html>
