<div class="btn-group">
    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-info">
        <i class="fas fa-edit"></i> Edit
    </a>
    <button type="button" class="btn btn-sm btn-danger delete-role ml-2" data-id="{{ $role->id }}">
        <i class="fas fa-trash"></i> Delete
    </button>
</div> 