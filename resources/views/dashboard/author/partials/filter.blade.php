<div class="card card-body mb-4">
    <form action="{{ route('dashboard.authors.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('author.author_name') }} </label>
                    <input type="text" name="author_name" class="form-control"
                        placeholder="{{ __('author.enter_author_name') }}" value="{{ request()->author_name }}">
                </div>
            </div>
        </div>
        <div class="col-md-12 text-end">
            <x-adminlte-button label="{{ __('author.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.authors.index') }}">
                <x-adminlte-button label="{{ __('author.reset') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>
