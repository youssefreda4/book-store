<div class="card card-body mb-4">
    <form action="{{ route('dashboard.books.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('book.book_name') }} </label>
                    <input type="text" name="book_name" class="form-control"
                        placeholder="{{ __('book.enter_book_name') }}" value="{{ request()->flashsale_name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('book.description') }} </label>
                    <input type="text" name="book_description" class="form-control"
                        placeholder="{{ __('book.enter_book_description') }}" value="{{ request()->flashsale_description }}">
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <x-adminlte-button label="{{ __('book.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.books.index') }}">
                <x-adminlte-button label="{{ __('book.reset') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>
