<div class="card card-body mb-4">
    <form action="{{ route('dashboard.admins.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('admin.admin_name') }} </label>
                    <input type="text" name="admin_name" class="form-control"
                        placeholder="{{ __('admin.enter_admin_name') }}" value="{{ request()->admin_name }}">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"> {{ __('admin.admin_email') }} </label>
                    <input type="text" name="admin_email" class="form-control"
                        placeholder="{{ __('admin.enter_admin_email') }}" value="{{ request()->admin_name }}">
                </div>
            </div>
        </div>
        <div class="col-md-12 text-end">
            <x-adminlte-button label="{{ __('admin.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.admins.index') }}">
                <x-adminlte-button label="{{ __('admin.reset') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>
