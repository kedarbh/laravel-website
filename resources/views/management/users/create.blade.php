@extends ('layouts.management')
@section ('content')


    <h2>Add New User</h2>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('users.store')}}" method="POST">
    {{csrf_field()}}
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Full Name">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Re-enter Password">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create New User</button>
        <a class="btn btn-secondary" href="{{route('users.index')}}">Cancel</a>
    </form>

@endsection
