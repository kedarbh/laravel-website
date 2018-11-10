@extends ('layouts.management')
@section ('content')

    <div class="col"><h2>Add New User</h2></div>
<hr>
    <form action="{{route('users.store')}}" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" aria-labelledby="Full Name" placeholder="Enter Full Name">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" aria-labelledby="Email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="submit" class="btn btn-secondary" onClick="{{route('users.index')}}">Cancel</button>
        </form>
@endsection
