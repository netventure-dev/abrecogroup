<div class="btn-group btn-group-sm mt-2" role="group" aria-label="Roles Action">
    @can('update', $role)
    <a href="{{ route('admin.roles.edit', $role) }}" class="first btn btn-primary edit" data-toggle="tooltip" title="Edit"><i
            class="fas fa-pencil-alt" data-toggle="tooltip" title="Edit"></i></a>
    @endcan @can('delete', $role)
    <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete"
        onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this row')}}')){ document.getElementById('delete-data-{{ $role->id }}').submit();}">
        <i class="fas fa-times"></i>
    </button>
    <form id="delete-data-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
    @endcan
</div>