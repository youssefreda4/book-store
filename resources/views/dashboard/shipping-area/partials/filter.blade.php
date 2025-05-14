<div class="card card-body mb-4">
    <form action="{{ route('dashboard.areas.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('area.area_name') }} </label>
                    <input type="text" name="area_name" class="form-control" placeholder="{{ __('area.enter_area_name') }}" value="{{ request()->area_name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('area.fee') }} </label>
                    <input type="number" name="area_fee" class="form-control" placeholder="{{ __('area.enter_area_fee') }}" value="{{ request()->area_fee }}" min="1">
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <x-adminlte-button label="{{ __('area.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.areas.index') }}">
                <x-adminlte-button label="{{ __('area.resert') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>
