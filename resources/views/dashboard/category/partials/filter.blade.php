<div class="card card-body mb-4">
    <form action="{{ route('dashboard.categories.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('category.category_name') }} </label>
                    <input type="text" name="category_name" class="form-control" placeholder="{{ __('category.enter_category_name') }}" value="{{ request()->category_name }}">
                </div>
            </div>
            <div class="col-md-6 ml-4">
                <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="discount" value="1">
                    <label class="form-check-label"> {{ __('category.discount') }} </label>
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <x-adminlte-button label="{{ __('category.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.categories.index') }}">
                <x-adminlte-button label="{{ __('category.resert') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>
