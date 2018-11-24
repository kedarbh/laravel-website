@extends ('layouts.management')
@section ('content')
    <h2>Edit Permission</h2>
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

    <form action="{{route('permissions.update', $permission->id)}}" method="POST">
    {{csrf_field()}} {{method_field('PUT')}}
    <div class="form-group">
            <label for="display_name">Name</label>
    <input type="text" class="form-control" id="display_name" name="display_name"  value="{{$permission->display_name}}" placeholder="Enter Display Name">
        </div>
        <div class="form-group">
            <label for="name">Slug</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$permission->name}}" placeholder="enter-slug" aria-describedby="slugHelpText" disabled>
            <small id="slugHelpText" class="form-text text-muted">Slug cannot be edited.</small>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="desription" name="description" value="{{$permission->description}}" placeholder="Enter Short Description">
        </div>
        <button type="submit" class="btn btn-primary">Update Permission</button>
        <a class="btn btn-secondary" href="{{route('permissions.index')}}">Cancel</a>
    </form>

@endsection
