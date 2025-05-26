<a href="{{ route('actions.edit', $action->action_id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
<button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $action->action_id }}"><i class="fas fa-trash"></i> Delete</button>
<script>
$(document).on('click', '.btn-delete', function() {
    var id = $(this).data('id');
    if (confirm('Are you sure you want to delete this action?')) {
        $.ajax({
            url: '/actions/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#actions-table').DataTable().ajax.reload();
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr) {
                alert('An error occurred while deleting the action.');
            }
        });
    }
});
</script> 