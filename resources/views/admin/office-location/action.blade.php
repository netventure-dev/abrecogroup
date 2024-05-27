<div class="mt-2 btn-group btn-group-sm" role="group" aria-label="Admin Action">
    {{-- @can('update', $admin) --}}
    <a href="{{ route('admin.office-location.edit',$blog->uuid) }}" class="first btn btn-primary edit"><i class="fas fa-pencil-alt"
            data-toggle="tooltip" title="Edit"></i></a>
    {{-- @endcan @can('delete', $admin) --}}
    <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this blog list')}}')){
        document.getElementById('delete-data-{{ $blog->uuid }}').submit();}">
        <i class="fas fa-trash-alt"></i>    `
    </button>
    <form id="delete-data-{{ $blog->uuid }}" action="{{ route('admin.office-location.destroy', $blog->uuid) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    {{-- @endcan --}}
</div>
