<div class="col-md-12">
    <div class="form-group">
        <label class="form-label" for="lesson">Lecon</label>
        <select
            class="form-control js-select2 @error('lesson') error @enderror"
            id="lesson"
            name="lesson"
            data-placeholder="Choisir la lesson"
            required>
            <option label="Choisir la lesson" value=""></option>
            @foreach(\App\Models\Lesson::all() as $campus)
                <option value="{{ $campus->id }}">{{ $campus->name }}</option>
            @endforeach
        </select>
    </div>
</div>
