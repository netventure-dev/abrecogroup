<div class="mt-2 btn-group btn-group-sm" role="group" aria-label="Admin Action">
    {{-- <a href="{{ route('admin.additional-pages.index',$page->uuid) }}" class="first btn btn-primary edit"> Content</a> --}}
    {{-- <a href="{{ route('admin.additional-pages.faq.index',$page->uuid) }}" class="first btn btn-primary edit"> Faq</a> --}}
    {{-- @can('update', $admin) --}}
    <a href="{{ route('admin.additional-pages.edit',$page->uuid) }}" class="first btn btn-primary edit"><i class="fas fa-pencil-alt"
            data-toggle="tooltip" title="Edit"></i></a>
    {{-- @endcan @can('delete', $admin) --}}
    <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this row')}}')){
        document.getElementById('delete-data-{{ $page->uuid }}').submit();}">
        <i class="fas fa-trash-alt"></i>
    </button>
    <form id="delete-data-{{ $page->uuid }}" action="{{ route('admin.additional-pages.destroy', $page->uuid) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    {{-- @endcan --}}
</div>
