<div class="col-md-3 col-lg-3">
    <div class="card">
        <div class="nk-ecwg nk-ecwg3">
            <a href="{{ $route ?? route('admins.backend.home') }}">
                <div class="card-inner pb-0">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title">{{ $name ?? "" }}</h6>
                        </div>
                    </div>
                    <div class="data">
                        <div class="data-group">
                            <div class="amount fw-normal">{{ $number ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
