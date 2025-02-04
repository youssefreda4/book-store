<div class="card card-body mb-4">
    <form action="{{ route('dashboard.authors.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> Author Name </label>
                    <input type="text" name="author_name" class="form-control" placeholder="Enter author name">
                </div>
            </div>
            <div>

                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-check-input" type="checkbox" name="discount" value="1">
                        <label class="form-check-label"> Discount </label>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-md-12 text-end">
            <x-adminlte-button label="Filter" theme="primary" type="submit" />
            <a href="{{ route('dashboard.authors.index') }}">
                <x-adminlte-button label="Resert" theme="secondary" />
            </a>
        </div>
    </form>
</div>
