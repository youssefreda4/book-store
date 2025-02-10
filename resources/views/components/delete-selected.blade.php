<button id="delete-selected" class="btn btn-danger" data-model="{{ $model }}"
    disabled>{{ __('adminlte::adminlte.delete_selected') }}</button>
@push('js')
    <script>
        const selectAll = document.getElementById('select-all');

        if (selectAll) {
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateButtonState);
            });
            handleSelectAllToDelete();
            handleDeleteSelected();
        }

        function handleSelectAllToDelete() {
            selectAll.addEventListener('change', function(event) {
                const checkboxes = document.querySelectorAll('.row-checkbox');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                updateButtonState(event);
            });
        }

        function handleDeleteSelected() {
            const deleteSelected = document.getElementById('delete-selected');
            deleteSelected.addEventListener('click', function(event) {
                const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked'))
                    .map(checkbox => checkbox.value);

                if (selectedIds.length === 0) {
                    Swal.fire(@json(__('adminlte::adminlte.no_items_selected')), @json(__('adminlte::adminlte.please_select_at_least_one_item_to_delete')), 'warning');
                    return;
                }

                Swal.fire({
                    title: @json(__('adminlte::adminlte.are_you_sure')),
                    text: @json(__('adminlte::adminlte.you_are_about_to_delete_selected_items')),
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: @json(__('adminlte::adminlte.Yes_delete_them')),
                    cancelButtonText: @json(__('adminlte::adminlte.No_cancel')),
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('/dashboard/delete-items', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    ids: selectedIds,
                                    model: event.target.dataset.model
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(@json(__('adminlte::adminlte.deleted')), data.message, 'success')
                                        .then(() => {
                                            location.reload();
                                        });
                                } else {
                                    Swal.fire(@json(__('adminlte::adminlte.error')), data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire(@json(__('adminlte::adminlte.error')), @json(__('adminlte::adminlte.something_went_wrong')),
                                    'error');
                            });
                    }
                });
            });
        }

        function updateButtonState(event) {
            const deleteButton = document.getElementById('delete-selected');
            deleteButton.disabled = !event.target.checked;
        }
    </script>
@endpush
