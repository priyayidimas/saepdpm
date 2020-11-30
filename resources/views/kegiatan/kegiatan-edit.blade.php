<form action="{{route('updateKegiatan')}}" method="POST">
    @method("put")
    @csrf
    <input type="hidden" name="id" value="{{$kegiatan->id}}">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form">
                <label for="">Divisi</label>
                <select name="divisi_id" id="" class="form-control browser-default" required>
                    @foreach ($divisi as $div)
                    <option value="{{$div->id}}" {{($div->id == $kegiatan->divisi_id) ? "selected" : ""}}>
                        {{$div->nama}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form">
                <label for="form1" class="">Nama Kegiatan</label>
                <input type="text" name="nama" id="form1" class="form-control" required value="{{$kegiatan->nama}}">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form">
                            <label for="date-picker-example">Input Tanggal (YYYY-MM-DD)</label>
                            <input placeholder=" " type="text" name="tanggal" id="date-picker-example" class="form-control datepicker" required value="{{$kegiatan->tanggal}}">
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
                <textarea class="form-control" name="keterangan" id="" cols="30" rows="4">{{$kegiatan->keterangan}}</textarea>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <button data-dismiss="modal" class="btn btn-secondary">Tutup</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
</form>
