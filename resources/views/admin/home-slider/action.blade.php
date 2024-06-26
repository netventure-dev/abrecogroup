<div class="mt-2 btn-group btn-group-sm" role="group" aria-label="Admin Action">
    {{-- @can('update', $admin) --}}
    <a href="{{ route('admin.home-slider.edit',$slider->uuid) }}" class="first btn btn-primary edit"><i class="fas fa-pencil-alt"
            data-toggle="tooltip" title="Edit"></i></a>
    {{-- @endcan @can('delete', $admin) --}}
    <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this home slider')}}')){
        document.getElementById('delete-data-{{ $slider->uuid }}').submit();}">
        <i class="fas fa-trash-alt"></i>
    </button>
    <form id="delete-data-{{ $slider->uuid }}" action="{{ route('admin.home-slider.destroy', $slider->uuid) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    {{-- @endcan --}}
</div>
