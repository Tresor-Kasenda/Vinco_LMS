<div class="col-md-12">
    <div class="form-group">
        <label class="form-label" for="chapter">Chapitre</label>
        <select
            class="form-control js-select2 @error('chapter') error @enderror"
            id="chapter"
            name="chapter"
            data-placeholder="Choisir le chapter"
            required>
            <option label="Choisir le chapter" value=""></option>
            @foreach(\App\Models\Chapter::all() as $campus)
                <option value="{{ $campus->id }}">{{ $campus->name }}</option>
            @endforeach
        </select>
    </div>
</div>
