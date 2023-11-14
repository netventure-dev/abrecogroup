<div class="mt-2 btn-group btn-group-sm" role="group" aria-label="Admin Action">
    <a href="{{ route('admin.sub-services.content.index',$subservice->uuid) }}" class="first btn btn-primary edit"> Content</a>
    {{-- <a href="{{ route('admin.sub-services.faq.index',$subservice->uuid) }}" class="first btn btn-primary edit"> Faq</a> --}}
    {{-- @can('update', $admin) --}}
    <a href="{{ route('admin.sub-services.edit',$subservice->uuid) }}" class="first btn btn-primary edit"><i class="fas fa-pencil-alt"
            data-toggle="tooltip" title="Edit"></i></a>
    {{-- @endcan @can('delete', $admin) --}}
    <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this subservice')}}')){
        document.getElementById('delete-data-{{ $subservice->uuid }}').submit();}">
        <i class="fas fa-trash-alt"></i>
    </button>
    <form id="delete-data-{{ $subservice->uuid }}" action="{{ route('admin.sub-services.destroy', $subservice->uuid) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    {{-- @endcan --}}
</div>
