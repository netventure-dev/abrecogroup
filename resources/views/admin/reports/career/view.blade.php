@extends('admin.layout.backend')

@section('content')
@component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
    <div class="content">
        <!-- Row #1 -->
        <h2 class="content-heading">View Details</h2>
        <table style="width:100%">
            <tr>
                <td style="width:50%">Name</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->name }}</td>
            </tr>
            <tr>
                <td style="width:50%">Email</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->email }}</td>
            </tr>
            <tr>
                <td style="width:50%">Position</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->position }}</td>
            </tr>
            <tr>
                <td style="width:50%">Phone</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->phone }}</td>
            </tr>
            <tr>
                <td style="width:50%">Message</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->message }}</td>
            </tr>
            <tr>
                <td style="width:50%">Resume</td>
                <td style="width:10%">:</td>
                <td style="width:40%"><a href="{{asset('storage/'.@$quote['resume'])}}">View</a></td>
                  
            </tr>
        </table>
    </div>
@endsection
@section('js_after')
@endsection
