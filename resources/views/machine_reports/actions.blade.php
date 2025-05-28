@if(Auth::id() === $report->user_id)
<a href="{{ route('machine-reports.edit', $report->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
<button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $report->id }}"><i class="fas fa-trash"></i> Delete</button>
@endif
<script>
$(document).on('click', '.btn-delete', function() {
    var id = $(this).data('id');
    if (confirm('Are you sure you want to delete this machine report?')) {
        $.ajax({
            url: '/machine-reports/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#machine-reports-table').DataTable().ajax.reload();
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr) {
                alert('An error occurred while deleting the machine report.');
            }
        });
    }
});
</script> 