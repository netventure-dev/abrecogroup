<div class="mt-2 btn-group btn-group-sm" role="group" aria-label="Admin Action">
    {{-- @can('update', $admin) --}}
    <a href="{{ route('admin.requestenquiry.view',$new->id) }}" class="first btn btn-primary edit"><i class="fa fa-eye"
            data-toggle="tooltip" title="Edit"></i></a>
    {{-- @endcan @can('delete', $admin) --}}
    <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this row')}}')){
        document.getElementById('delete-data-{{ $new->id }}').submit();}">
        <i class="fas fa-trash-alt"></i>
    </button>
    <form id="delete-data-{{ $new->id }}" action="{{ route('admin.requestenquiry.destroy', $new->id) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    {{-- @endcan --}}
</div>
