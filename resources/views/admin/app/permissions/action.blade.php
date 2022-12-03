<div class="btn-group btn-group-sm mt-2" role="group" aria-label="Permission Action">
    @can('update', $model)
    <a href="{{ route('admin.permissions.edit', $model) }}" class="first btn btn-primary edit" data-toggle="tooltip"
        title="Edit"><i class="fas fa-pencil-alt" data-toggle="tooltip" title="Edit"></i></a>
    @endcan @can('delete', $model)
    <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete"
        onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this row')}}')){ document.getElementById('delete-data-{{ $model->id }}').submit();}">
        <i class="fas fa-times"></i>
    </button>
    <form id="delete-data-{{ $model->id }}" action="{{ route('admin.permissions.destroy', $model) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    @endcan
</div>