<div class="card-body border-bottom py-3">
    <form method="post" action="{{ route('admins.settings.update', ['setting' => auth()->user()->setting->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="form-group mb-3 row">
                    <label for="name" class="form-label col-md-3 col-form-label">App Name</label>
                    <div class="col-md-9">
                        <input
                            type="text"
                            placeholder="Name"
                            id="name"
                            name="app_name"
                            value="{{ old('app_name') ?? auth()->user()->setting->app_name }}"
                            class="form-control @error('app_name') error @enderror">
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="name" class="form-label col-md-3 col-form-label">App Short Name</label>
                    <div class="col-md-9">
                        <input
                            type="text"
                            placeholder="short_name"
                            id="short_name"
                            name="short_name"
                            value="{{ old('short_name') ?? auth()->user()->setting->short_name }}"
                            class="form-control @error('short_name') error @enderror">
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="email" class="form-label col-md-3 col-form-label">Email</label>
                    <div class="col-md-9">
                        <input
                            type="email"
                            placeholder="Email"
                            id="email"
                            name="app_email"
                            value="{{ old('app_email') ?? auth()->user()->setting->app_email }}"
                            class="form-control @error('app_email') error @enderror">
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="phone" class="form-label col-md-3 col-form-label">
                        Phone
                    </label>
                    <div class="col-md-9">
                        <input
                            type="text"
                            placeholder="Phone"
                            id="phone"
                            name="app_phone"
                            value="{{ old('app_phone') ?? auth()->user()->setting->app_phone }}"
                            class="form-control @error('app_phone') error @enderror">
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="address" class="form-label col-md-3 col-form-label">Address</label>
                    <div class="col-md-9">
                        <textarea
                            rows="8"
                            id="address"
                            name="app_address"
                            class="form-control @error('app_address') error @enderror">{{ old('app_address') ?? auth()->user()->setting->app_address }}</textarea>
                    </div>
                </div>
            </div>
            <div class="ml-5 col-xl-4">
                <div class="form-group row">
                    <label for="name" class="form-label col-md-3 col-form-label">Favicon</label>
                    <div class="col-md-9">
                        <img
                            width="32px"
                            height="32px"
                            @if(auth()->user()->setting->app_icons)
                                src="{{ asset('storage/'. auth()->user()->setting->app_icons) }}"
                            @else
                                src="{{ asset('storage/') }}"
                            @endif
                            alt="image"
                            class="mb-3 border border-secondary"><br>
                        <input
                            type="file"
                            name="app_icons"
                            class="@error('app_icons') error @enderror"
                            accept="image/png, image/ico">
                    </div>
                </div>
                <div class="form-group my-4 row">
                    <label for="name" class="form-label col-md-3 col-form-label">Logo</label>
                    <div class="col-md-9">
                        <img
                            width="200px"
                            height="50px"
                            @if(auth()->user()->setting->app_images)
                                src="{{ asset('storage/'. auth()->user()->setting->app_images) }}"
                            @else
                                src="{{ asset('storage/') }}"
                            @endif
                            alt="image"
                            class="mb-3 border border-secondary"><br>
                        <input type="file" name="app_images" id="images" class="@error('app_images') error @enderror">
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <button type="submit" class="btn btn-primary btn-dim mt-3 mr-3">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
