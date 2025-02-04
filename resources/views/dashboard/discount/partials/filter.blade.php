<div class="card card-body mb-4">
    <form action="{{ route('dashboard.discounts.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> Discount Code </label>
                    <input type="text" name="discount_code" class="form-control" placeholder="Enter Discount Code">
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
            <a href="{{ route('dashboard.discounts.index') }}">
                <x-adminlte-button label="Resert" theme="secondary" />
            </a>
        </div>
    </form>
</div>
