<div class="row">
    <div class="col">
        <form action="{{route('updateIndikator')}}" method="post">
            @csrf
            @method("PUT")
                <input type="hidden" name="id" value="{{$data->id}}">
                <input type="hidden" id="sect_id" name="section_id" value="{{$data->section_id}}">
                <div class="md-form">
                    <input type="text" class="form-control" name="variabel" value="{{$data->variabel}}">
                    <label class="active" for="variabel">Variabel</label>
                </div>
                <div class="md-form">
                    <input type="text" class="form-control" name="indikator" value="{{$data->indikator}}">
                    <label class="active" for="indikator">Indikator</label>
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
                            <input class="form-check-input filled-in" name="val[0]" type="checkbox" id="valeo1" {{($data->n1 != 0) ? 'checked' : ''}} value="1">
                            <label class="form-check-label" for="valeo1">1</label>
                        </fieldset>
                    </div>
                    <div class="col">
                        <fieldset class="form-check">
                            <input type="hidden" name="val[1]" value="0">
                            <input class="form-check-input filled-in" name="val[1]" type="checkbox" id="valeo2" {{($data->n2 != 0) ? 'checked' : ''}} value="1">
                            <label class="form-check-label" for="valeo2">2</label>
                        </fieldset>
                    </div>
                    <div class="col">
                        <fieldset class="form-check">
                            <input type="hidden" name="val[2]" value="0">
                            <input class="form-check-input filled-in" name="val[2]" type="checkbox" id="valeo3" {{($data->n3 != 0) ? 'checked' : ''}} value="1">
                            <label class="form-check-label" for="valeo3">3</label>
                        </fieldset>
                    </div>
                    <div class="col">
                        <fieldset class="form-check">
                            <input type="hidden" name="val[3]" value="0">
                            <input class="form-check-input filled-in" name="val[3]" type="checkbox" id="valeo4" {{($data->n4 != 0) ? 'checked' : ''}} value="1">
                            <label class="form-check-label" for="valeo4">4</label>
                        </fieldset>
                    </div>
                </div>
                <div class="md-form">
                    <textarea type="text" id="eval" name="keterangan" class="form-control md-textarea" rows="4">{!! str_replace("<br />","&#13;",$data->keterangan) !!}</textarea>
                    <label class="active" for="keterangan">Keterangan</label>
                </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </form>
    </div>
</div>
