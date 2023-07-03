@extends('admin.layout.backend')

@section('content')
    <div class="content">
        <!-- Row #1 -->
        <h2 class="content-heading">View Details</h2>
        <table style="width:100%">
            <tr>
                <td>Name</td><br>
                <td>Email</td>
                <td>Type</td>
                <td>Service</td>
                <td>Phone</td>
                <td>message</td>
            </tr>
            <tr>
                <td>{{ @$quote->name }}</td>
                <td>{{ @$quote->email }}</td>
                <td>{{ @$quote->type }}</td>
                <td>{{ @$quote->service }}</td>
                <td>{{ @$quote->phone }}</td>
                <td>{{ @$quote->message }}</td>



            </tr>
        </table>
    </div>
@endsection
@section('js_after')
@endsection
