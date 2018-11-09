@extends ('layouts.management')
@section ('content')
    <h2>Manage Users</h2>

    <div>
        <table class="table table-striped shadow p-3">
            <thead class="bg-secondary">
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
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <!-- <td>{{$user->role}}</td> -->
                    <td>Actions</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
