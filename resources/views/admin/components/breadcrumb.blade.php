<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ $title }}</h4>
            <div class="page-title-right">
                 <ol class="breadcrumb m-0">
                    @if(isset($breadcrumbs))
                    @foreach ($breadcrumbs as $breadcrumb)

                    @if (!is_null($breadcrumb[1]) && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb[1] }}">{{ $breadcrumb[0] }}</a></li>
                    @else
                    <li class="breadcrumb-item active">{{ $breadcrumb[0] }}</li>
                    @endif

                    @endforeach
                    @endif
                </ol> 
            </div>

        </div>
    </div>
</div>
<!-- end page title -->