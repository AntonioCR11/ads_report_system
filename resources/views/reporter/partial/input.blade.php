<div class="form-group row mb-2">
    @if ($input->input_type == 'text' || $input->input_type == 'date')
        <label class="col-md-4 col-form-label text-md-right">{{ $input->title }}</label>
        <div class="col">
            <input type="{{ $input->input_type }}" id="{{ $input->form_data }}" class="form-control"
                name="{{ $input->form_data }}" value="{{ old($input->form_data) }}" >
        </div>
    @elseif ($input->input_type == 'select')
        <label class="col-md-4 col-form-label text-md-right">Tipe Identitas:</label>
        <div class="col">
            <select class="w-50 p-2" name="identity_type" id="identity_type">
                <option value="KTP">KTP</option>
                <option value="SIM">SIM</option>
            </select>
        </div>
    @elseif ($input->input_type == 'textarea')
        <label class="col-md-4 col-form-label text-md-right">Deskripsi Laporan</label>
        <div class="col">
            <textarea class="w-100" rows="4" name="description" id="description" >{{ old('description') }}</textarea>
        </div>
    @endif

</div>
