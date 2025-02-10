<div class="card card-body mb-4">
    <form action="{{ route('dashboard.flashsales.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('flashsale.flash_sale_name') }} </label>
                    <input type="text" name="flashsale_name" class="form-control"
                        placeholder="{{ __('flashsale.enter_flash_sale_name') }}" value="{{ request()->flashsale_name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('flashsale.description') }} </label>
                    <input type="text" name="flashsale_description" class="form-control"
                        placeholder="{{ __('flashsale.enter_flash_sale_description') }}" value="{{ request()->flashsale_description }}">
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <x-adminlte-button label="{{ __('flashsale.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.flashsales.index') }}">
                <x-adminlte-button label="{{ __('flashsale.resert') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>
