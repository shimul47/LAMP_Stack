@extends('layouts.app')

@section('content')
{{-- {{$user}} --}}
<div class="card-body">
    <div class="table-responsive  ">
        <table class="table data">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Verified At</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Operation</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('.data').DataTable({
            serverSide:true,
            processing:true,
            ajax:{
                url:'{{route("data")}}'
            },
            columns:[
                {data: "name", name:"name"},
                {data:"email",name:"email"},
                {data:"email_verified_at", name:"email_verified_at"},
                {data:"created_at", name:"created_at"},
                {data:"updated_at",name:"updated_at"},
                {data:"operation",name:"operation",orderable:false,},
            ]
        });
    });
</script>

@endsection
