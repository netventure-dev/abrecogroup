@extends('admin.layout.backend')


@section('content')
{{-- <a href="{{ route('admin.enquiries.index') }}" class="btn btn-primary">Back</a><br> --}}
@component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
    <div class="content">
        <!-- Row #1 -->
        <h2 class="content-heading">Message</h2>
        {{-- <a href="back-url" class="btn btn-primary">Back</a><br> --}}

        <table style="width:100%"><br>
            {{-- <tr style="padding-bottom: 10px;">
                <td style="width:50%">Message</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->message }}</td>
            </tr> --}}
            <tr>
                <td style="width:40%">
                    <textarea rows="4" cols="50" readonly>{{ @$quote->message }}</textarea>
                </td>
            </tr>
        </table>
    </div>
@endsection
@section('js_after')
@endsection
