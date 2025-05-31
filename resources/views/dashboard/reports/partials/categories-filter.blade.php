<div class="card card-body mb-4">
    <form action="{{ route('dashboard.report.most.selling.categories') }}" method="GET">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name"> {{ __('category.category_name') }} </label>
                    <input type="text" name="category_name" class="form-control"
                        placeholder="{{ __('category.enter_category_name') }}" value="{{ request()->category_name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="total_quantity_sold_from">{{ __('soldBooksReport.total_quantity_sold_from') }}</label>
                    <input type="number" name="total_quantity_sold_from" class="form-control"
                        placeholder="{{ __('soldBooksReport.example') }}: {{ translateNumberToLocale($locale,10,0) }}"
                        value="{{ request()->total_quantity_sold_from }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="total_quantity_sold_to">{{ __('soldBooksReport.total_quantity_sold_to') }}</label>
                    <input type="number" name="total_quantity_sold_to" class="form-control"
                        placeholder="{{ __('soldBooksReport.example') }}: {{ translateNumberToLocale($locale,100,0) }}"
                        value="{{ request()->total_quantity_sold_to }}">
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <x-adminlte-button label="{{ __('category.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.report.most.selling.categories') }}">
                <x-adminlte-button label="{{ __('category.resert') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>