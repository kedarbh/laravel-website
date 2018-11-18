@extends ('layouts.management')
@section ('content')
    <div class="row m-b-30" >
        <div class="col"><h2>Manage Permissions</h2></div>
        <div class="col text-right"><a class="btn btn-success btn-lg" href="{{route('permissions.create')}}">Add New Permission</a></div>
    </div>
    <table class="table table-sm table-striped shadow p-3 table-bordered">
        <thead class="bg-secondary text-white">
            <tr>
            <th>S.N.</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
            </tr>
        </thead>
        @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->display_name}}</td>
                <td>{{$permission->description}}</td>
                <td><a class="btn btn-dark btn-sm" href="{{route('permissions.show', $permission->id)}}">View</a>
                <a class="btn btn-primary btn-sm" href="{{route('permissions.edit', $permission->id)}}">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {{$permissions->render()}}
    </div>

@endsection
