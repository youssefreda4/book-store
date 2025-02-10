<div class="card card-body mb-4">
    <form action="{{ route('dashboard.publishers.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('publisher.publisher_name') }} </label>
                    <input type="text" name="publisher_name" class="form-control" placeholder="{{ __('publisher.enter_publisher_name') }}" value="{{ request()->publisher_name }}">
                </div>
            </div>
        </div>
        <div class="col-md-12 text-end">
            <x-adminlte-button label="{{ __('publisher.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.publishers.index') }}">
                <x-adminlte-button label="{{ __('publisher.resert') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>
