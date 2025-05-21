<div class="btn-group">
    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-info">
        <i class="fas fa-edit"></i> Edit
    </a>
    <button type="button" class="btn btn-sm btn-danger delete-permission ml-2" data-id="{{ $permission->id }}">
        <i class="fas fa-trash"></i> Delete
    </button>
</div> 