@php
    if (auth()->user()->hasRole('Super Admin')){
        $institutions = \App\Models\Institution::query()
             ->select(['id', 'institution_name'])
             ->get();
        $departments = \App\Models\Department::query()
            ->select(['campus_id', 'name','id'])
            ->with([
               'campus:id,name,institution_id' => [
                  'institution:id,institution_name'
               ]
            ])
            ->get();
    } else {
        $departments = \App\Models\Department::query()
            ->select(['campus_id', 'name','id'])
            ->with([
               'campus:id,name,institution_id' => [
                  'institution:id,institution_name'
               ]
            ])
            ->whereHas('campus', function ($builder){
                $builder->where('institution_id', auth()->user()->institution->id);
            })
            ->get();
    }
@endphp

@if(auth()->user()->hasRole('Super Admin'))
    <div {{ $attributes->class(['col-md-12']) }}>
        <div class="form-group">
            <label class="form-label" for="institution">Institution</label>
            <div class="form-control-wrap">
                <select
                        class="form-control js-select2 select2-hidden-accessible @error('institution') error @enderror"
                        id="institution"
                        name="institution"
                        data-search="on"
                        data-placeholder="Select Institution">
                    <option label="institution" value=""></option>
                    @foreach($institutions as $institution)
                        <option value="{{ $institution->id }}">
                            {{ ucfirst($institution->institution_name) ?? "" }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endif

<div class="col-md-12">
    <div class="form-group">
        <label class="form-label" for="department">Departement</label>
        <div class="form-control-wrap">
            <select
                    class="form-control js-select2 select2-hidden-accessible @error('department') error @enderror"
                    id="department"
                    name="department"
                    data-search="on"
                    data-placeholder="Select Department">
                <option label="department" value=""></option>
                @forelse($departments as $department)
                    <option value="{{ $department->id }}">
                        {{ ucfirst($department->name ) ?? "" }}/
                        @if(auth()->user()->hasRole('Super Admin'))
                            (<small>{{ ucfirst($department->campus->institution->institution_name) ?? "" }}</small>)
                        @endif
                    </option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="filiaire">Filiaire</label>
        <div class="form-control-wrap">
            <select
                    class="form-control js-select2 select2-hidden-accessible @error('filiaire') error @enderror"
                    id="filiaire"
                    name="filiaire"
                    data-search="on"
                    data-placeholder="Select Filiaire"
            >

            </select>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="promotion">Promotion</label>
        <div class="form-control-wrap">
            <select
                    class="form-control js-select2 select2-hidden-accessible @error('class') error @enderror"
                    id="promotion"
                    name="promotion"
                    data-search="on"
                    data-placeholder="Select Promotion"
            >

            </select>
        </div>
    </div>
</div>
