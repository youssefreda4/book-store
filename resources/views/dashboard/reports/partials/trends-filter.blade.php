<div class="card card-body mb-4">
    <form action="{{ route('dashboard.report.sales.trends') }}" method="GET">
        <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                    <label for="name"> {{ __('book.book_name') }} </label>
                    <input type="text" name="book_name" class="form-control"
                        placeholder="{{ __('book.enter_book_name') }}" value="{{ request()->book_name }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="total_quantity_sold_from">{{ __('trends.total_quantity_sold_from') }}</label>
                    <input type="number" name="total_quantity_sold_from" class="form-control"
                        placeholder="{{ __('trends.example') }}: {{ translateNumberToLocale($locale,10,0) }}"
                        value="{{ request()->total_quantity_sold_from }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="total_quantity_sold_to">{{ __('trends.total_quantity_sold_to') }}</label>
                    <input type="number" name="total_quantity_sold_to" class="form-control"
                        placeholder="{{ __('trends.example') }}: {{ translateNumberToLocale($locale,100,0) }}"
                        value="{{ request()->total_quantity_sold_to }}">
                </div>
            </div>
        </div>
       
        <div class="col-md-12 ">
            <x-adminlte-button label="{{ __('book.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.report.sales.trends') }}">
                <x-adminlte-button label="{{ __('book.reset') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>