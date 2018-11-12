@extends ('layouts.management')
@section ('content')
    <div class="row m-b-30" >
        <div class="col"><h2>Manage Users</h2></div>
        <div class="col text-right"><a class="btn btn-success btn-lg" href="{{route('users.create')}}">Add New User</a></div>
    </div>
    <table class="table table-striped shadow p-3 table-bordered">
        <thead class="bg-secondary text-white">
            <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>Email</th>
            <!-- <th>Role</th> -->
            <th>Action</th>
            </tr>
        </thead>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><a href="{{route('users.show', $user->id)}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <!-- <td>{{$user->role}}</td> -->
                <td><a class="btn btn-primary btn-sm" href="{{route('users.edit', $user->id)}}">Edit</a>
                    <a class="btn btn-danger btn-sm" href="{{route('users.destroy', $user->id)}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {{$users->render()}}
    </div>

@endsection
