<div class="card-body border-bottom py-3">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{ route('admins.system.update', ['system' => auth()->user()->setting->id]) }}" class="mt-2">
                @csrf
                @method('PUT')
                <div class="form-group mb-3 row">
                    {!! $times->toSelectBox('timezone', 'Africa', [
                        'class' => 'form-control js-select2'
                    ])  !!}
                </div>
                <div class="form-group mb-3 row">
                    <div class="form-group">
                        <label class="form-label" for="routine_time_difference">Heure par cours</label>
                        <select
                            class="form-control js-select2 @error('routine_time_difference') error @enderror"
                            id="routine_time_difference"
                            name="routine_time_difference"
                            required>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                            <option value="35">35</option>
                            <option value="40">40</option>
                            <option value="45">45</option>
                            <option value="50">50</option>
                            <option value="55">55</option>
                            <option value="60">60</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="class_start">Heure de debut</label>
                            <div class="form-control-wrap">
                                <input
                                    type="text"
                                    id="class_start"
                                    name="class_start"
                                    value="{{ old('class_start') ?? auth()->user()->setting->class_start }}"
                                    class="form-control time-picker @error('class_start') error @enderror"
                                    placeholder="Input placeholder">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="class_end">Heure de fin</label>
                            <div class="form-control-wrap">
                                <input
                                    type="text"
                                    id="class_end"
                                    name="class_end"
                                    value="{{ old('class_end') ?? auth()->user()->setting->class_end }}"
                                    class="form-control time-picker @error('class_end') error @enderror"
                                    placeholder="Input placeholder">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 text-center  mt-3">
                    <button type="submit" class="btn btn-primary btn-dim">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




