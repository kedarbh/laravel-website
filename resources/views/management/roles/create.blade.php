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

    <form action="{{route('roles.store')}}" method="POST">
        {{csrf_field()}}
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="display_name"><strong>Display Name</strong></label>
                            <input type="text" class="form-control" id="display_name" name="display_name"  placeholder="Enter Display Name">
                        </div>
                        <div class="form-group">
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="description"><strong>Description</strong></label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter short description">
                        </div>
                        <button type="submit" class="btn btn-primary">Create New Role</button>
                        <a class="btn btn-secondary" href="{{route('roles.index')}}">Cancel</a>
                    </div>
                </div>
            </div>
            <input type="hidden" :value="permissionSelected" name="permissions">
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
                                <input type="checkbox" class="custom-control-input" id="{{$permission->name}}" :value="{{$permission->id}}" v-model="permissionSelected">
                                <label class="custom-control-label" for="{{$permission->name}}">{{$permission->display_name}} ({{$permission->description}})</label>
                            </div>

                            @endforeach
                        </ul>
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
                permissionSelected: [],
                selectAll: false
            },
            methods: {
                select:function() {//function to select all permissions
                    this.permissionSelected = [];
                    if (!this.selectAll) {
                        this.permissionSelected = {!!$permissions->pluck('id')!!} ;
                    }
		        }
            }
        });
    </script>
@endsection
