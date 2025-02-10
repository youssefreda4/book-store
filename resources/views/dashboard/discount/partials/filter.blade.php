<div class="card card-body mb-4">
    <form action="{{ route('dashboard.discounts.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{__('discount.discount_code')}} </label>
                    <input type="text" name="discount_code" class="form-control" placeholder="{{ __('discount.enter_discount_code') }}" value="{{ request()->discount_code }}">
                </div>
            </div>
        </div>
        <div class="col-md-12 text-end">
            <x-adminlte-button label="{{ __('discount.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.discounts.index') }}">
                <x-adminlte-button label="{{ __('discount.resert') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>
