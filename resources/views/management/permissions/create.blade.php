@extends ('layouts.management')
@section ('content')
    <h2>Add New Permission</h2>
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

    <form action="{{route('permissions.store')}}" method="POST">
    {{csrf_field()}}
        <div class="row">
            <div class="col">
                <div class="form-check">
                    <input v-model='permissionType' class="form-check-input" type="radio" name="permission_type" id="basic" value="basic">
                    <label class="form-check-label" for="basic">
                      Basic Permission
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check">
                    <input v-model='permissionType' class="form-check-input" type="radio" name="permission_type" id="crud" value="crud">
                    <label class="form-check-label" for="crud">
                      CRUD Permission
                    </label>
                </div>
            </div>
        </div>

        <div class="row m-t-50" v-show="permissionType == 'basic'">
            <div class="col">
                <div class="form-group">
                    <label for="display_name">Name</label>
                    <input type="text" class="form-control" id="display_name" name="display_name"  placeholder="Enter Display Name">
                </div>
                <div class="form-group">
                    <label for="name">Slug</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="slugHelpText" placeholder="enter-slug-in-dashed-format">
                    <small id="slugHelpText" class="form-text text-muted">Type correctly; Slug cannot be edited.</small>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="desription" name="description" placeholder="Enter Short Description">
                </div>
            </div>

        </div>

        <div class="row m-t-50" v-show="permissionType == 'crud'">
            <div class="col">
                <div class="form-group">
                    <label for="resource">Resource Name</label>
                    <input type="text" class="form-control" id="resource" name="resource" v-model="resource" placeholder="Enter Display Name">
                </div>
            </div>
        </div>

        <div class="row" v-if="permissionType == 'crud'">
            <div class="col">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="create" value="create" v-model="crudSelected">
                    <label class="custom-control-label" for="create">Create</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="read" value="read" v-model="crudSelected">
                    <label class="custom-control-label" for="read">Read</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="update" value="update" v-model="crudSelected">
                    <label class="custom-control-label" for="update">Update</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="delete" value="delete" v-model="crudSelected">
                    <label class="custom-control-label" for="delete">Delete</label>
                </div>
            </div>
            <input type="hidden" name="crud_selected" :value="crudSelected">
            <div class="col-8">
                <table class="table table-sm table-striped shadow p-3 table-bordered">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody v-if="resource.length >= 3 && crudSelected.length > 0">
                        <tr v-for="item in crudSelected">
                        <td v-text="crudName(item)"></td>
                        <td v-text="crudSlug(item)"></td>
                        <td v-text="crudDescription(item)"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col">
                <button type="submit" class="btn btn-primary">Create New Permission</button>
                <a class="btn btn-secondary" href="{{route('permissions.index')}}">Cancel</a>
            </div>
        </div>
    </form>

@endsection

@section('scripts')

<script>
    var app = new Vue({
        el: '#app',
        data: {
            permissionType: 'basic',
            resource: '',
            crudSelected: ['create', 'read', 'update', 'delete']
        },

        methods: {
            crudName: function(item) {
                return item.substr(0,1).toUpperCase() + item.substr(1) + " " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
            },
            crudSlug: function(item) {
                return item.toLowerCase() + "-" + app.resource.toLowerCase();
            },
            crudDescription: function(item) {
                return "Allows User to " + item.toUpperCase() + " " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
            }
        }
    });
</script>

@endsection
