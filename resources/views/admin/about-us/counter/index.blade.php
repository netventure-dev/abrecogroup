@extends('admin.layout.backend')

@section('title')
    {{ __('Create Our Impact') }}
@endsection
@section('css')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
    @component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('title')
        @endslot
    @endcomponent
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Counter') }}</h4>
                <div class="page-title-right">

                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- start administrator create form -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="mt-2 row">
                        <div class="col-lg-12">
                            <form action="{{route('admin.couters.store')}}" method="post" class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                            <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Counter Title') }}<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input id="title" name="title" type="text" class="form-control mb-2 @if ($errors->has('title')) is-invalid @endif" placeholder="{{ __('Enter Counter Title') }}"  value="" required>
                                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            </div>
                        </div>
         
                        <div class="mb-4 row">
                            <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Counter') }}<span class="text-danger"></span></label>
                            <div class="col-sm-9">
                                <input id="counter" name="counter" type="text" class="form-control mb-2 @if ($errors->has('counter')) is-invalid @endif" placeholder="{{ __('Enter Counter') }}"  value="" >
                                <div class="invalid-feedback">{{ $errors->first('counter') }}</div>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Order') }}<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input id="order" name="order" type="number" class="form-control mb-2 @if ($errors->has('order')) is-invalid @endif" placeholder="{{ __('Enter order') }}"  value="" required>
                                <div class="invalid-feedback">{{ $errors->first('order') }}</div>
                            </div>
                        </div>

                                <br>
                                <div class="mb-4 row">
                                    <label for="horizontal-firstname-input"
                                        class="col-sm-3 col-form-label">{{ __('Status') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status1"
                                                value="1" @if (!@old('status')) checked @endif>
                                            <label class="form-check-label" for="status1">{{ __('Active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="0" @if (@old('status')) checked @endif>
                                            <label class="form-check-label" for="status2">{{ __('Inactive') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit"
                                                class="btn btn-primary w-md">{{ __('Submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 row">
                        <div class="col-lg-12">
                            <h3 class="block-title">View Value List</h3>
                            <div class="table-responsive">
                                <table class="table table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Counter</th>
                                            <th>Order</th>
                                            <th>Actions</th>
                                            <th>Last Modified</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($counter->count())
                                            @foreach ($counter as $data)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="font-w600">{{ $data->title }}</td>
                                                    <td>
                                                        @if ($data->status == 1)
                                                            <span class="btn btn-success btn-sm">Active</span>
                                                        @else
                                                            <span class="btn btn-danger btn-sm">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td class="font-w600">{{ $data->counter }}</td>
                                                    <td class="font-w600">{{ $data->order }}</td>
                                                    <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.couters.edit', $data->uuid) }}"
                                                        class="btn btn-primary w-md" data-toggle="tooltip"
                                                        title="Edit">Edit</a>
                                                        <button type="button" class="btn btn-outline-dark"
                                                                data-toggle="tooltip" title="Delete"
                                                                onclick="event.preventDefault(); if(confirm('Are you sure to delete impact list ?')){ document.getElementById('delete-row-{{ $data->uuid }}').submit();}">
                                                            Delete
                                                        </button>
                                                        <form id="delete-row-{{ $data->uuid }}" method="POST"
                                                            action="{{ route('admin.couters.destroy', $data->uuid) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>

                                                    </td>
                                                    <td>{{ $data->updated_at->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="no-data">
                                                <td colspan="5" class="text-center">No data available in table</td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                            {{ $counter->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    <!-- end administrator create form -->
    
    <!-- end administrator create form -->
@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
         $(document).ready(function() {
            $('.summernote').summernote();
        });           
    </script>
@endsection