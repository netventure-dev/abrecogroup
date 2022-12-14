<div class="mt-2 btn-group btn-group-sm" role="group" aria-label="rod Action">
    {{-- @can('update', $size) --}}
    <a href="{{ route('admin.rods.edit',$rod->id) }}" class="first btn btn-primary edit"><i class="fas fa-pencil-alt"
            data-toggle="tooltip" title="Edit"></i></a>
    {{-- @endcan @can('delete', $rod) --}}
    <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this row')}}')){
        document.getElementById('delete-data-{{ $rod->id }}').submit();}">
        <i class="fas fa-trash-alt"></i>
    </button>
    <form id="delete-data-{{ $rod->id }}" action="{{ route('admin.rods.destroy', $rod->id) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    {{-- @endcan --}}
</div>
