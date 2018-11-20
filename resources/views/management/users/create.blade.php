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
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Enter Full Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Enter email">
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
                    </div>
                </div>
            </div>
            <input type="hidden" :value="roleSelected" name="roles">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <strong>Permissions</strong>
                    </div>
                    <div class="card-body">
                        @foreach ($roles as $role)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$role->name}}" :value="{{$role->id}}" v-model="roleSelected">
                                <label class="custom-control-label" for="{{$role->name}}">{{$role->display_name}} ({{$role->description}})</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                roleSelected: [{!! old('roles') ? old('roles') : '' !!}]
            }
        });
    </script>
@endsection
