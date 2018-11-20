@extends ('layouts.management')
@section ('content')


    <h2>Edit {{$role->display_name}}</h2>
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

    <div class="row">
        <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{route('roles.update', $role->id)}}" method="POST">
                            {{ method_field('PUT') }}{{csrf_field()}}
                            <div class="form-group">
                                <label for="display_name"><strong>Display Name:</strong></label>
                                <input type="text" class="form-control" id="display_name" name="display_name"  value="{{$role->display_name}}" placeholder="Enter Display Name">
                            </div>
                            <div class="form-group">
                                <label for="name"><strong>Name:</strong></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}" disabled>
                                <small><em class="text-danger">You are not allowed to change.</em></small>
                            </div>
                            <div class="form-group">
                                <label for="description"><strong>Description:</strong></label>
                                <input type="text" class="form-control" id="description" name="description" value="{{$role->description}}">
                            </div>
                            <input type="hidden" value="permissionsSelected" name="permissions" v-model="permissions">
                            <button type="submit" class="btn btn-primary">Update Role</button>
                            <a class="btn btn-secondary" href="{{route('roles.index')}}">Cancel</a>
                        </form>
                    </div>
                </div>
        </div>
        {{-- <input type="hidden" value="permissionSelected" name="permission"> --}}
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                    <strong>Permissions:</strong>
                </div>
                <div class="card-body">
                        <div class="custom-control custom-checkbox m-t-20">
                            <input type="checkbox" class="custom-control-input" id="select-all" v-model="selectAll" @click="select">
                            <label class="custom-control-label" for="select-all"><strong>Select All</strong></label>
                        </div>
                        <ul>
                            @foreach ($permissions as $permission)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$permission->name}}" value="{{$permission->id}}" v-model="permissionSelected">
                                <label class="custom-control-label" for="{{$permission->name}}">{{$permission->display_name}} ({{$permission->description}})</label>
                            </div>

                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                permissionSelected: {!!$role->permissions->pluck('id')!!},
                selectAll: false,
                permissions:[]
            },
            methods: {
                select:function() {//function to select all permissions
                    this.permissionSelected = [];
                    // check = [];
                    if (!this.selectAll) {
                        this.permissionSelected = {!!$permissions->pluck('id')!!} ;
                        // check = this.permissionSelected.map((item) => {
                        //     return item.toString();
                        // });
                    }
                    // this.permissionSelected = check;
                    this.permissions = this.permissionSelected;
		        }
            }
        });
    </script>
@endsection
