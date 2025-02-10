<button type="button" class="btn btn-success" data-toggle="modal" data-target="#importExcelModal">
    <i class="fas fa-file-import"></i>{{__('adminlte::adminlte.import')}}
</button>

<div class="modal fade" id="importExcelModal" tabindex="-1" role="dialog" aria-labelledby="importExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importExcelModalLabel">{{ __('adminlte::adminlte.import_excel_file') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="model" value="{{$model}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">{{ __('adminlte::adminlte.select_excel_file') }}</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('adminlte::adminlte.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.upload') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>