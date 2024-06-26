<div class="mt-2 btn-group btn-group-sm" role="group" aria-label="Admin Action">
    <a href="{{ route('admin.casestudies.contents.index',$case->uuid) }}" class="first btn btn-primary edit"> Contents</a>
    {{-- <a href="{{ route('admin.sections.faq.index',$section->uuid) }}" class="first btn btn-primary edit"> Faq</a> --}}
    {{-- @can('update', $admin) --}}
    <a href="{{ route('admin.casestudies.edit',$case->uuid) }}" class="first btn btn-primary edit"><i class="fas fa-pencil-alt"
            data-toggle="tooltip" title="Edit"></i></a>
    {{-- @endcan @can('delete', $admin) --}}
    <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this casestudy')}}')){
        document.getElementById('delete-data-{{ $case->uuid }}').submit();}">
        <i class="fas fa-trash-alt"></i>
    </button>
    <form id="delete-data-{{ $case->uuid }}" action="{{ route('admin.casestudies.destroy', $case->uuid) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    {{-- @endcan --}}
</div>
