@extends ('layouts.management')
@section ('content')

<p><a href="{{route('roles.index')}}"><strong>&larr; Back</strong></a></p>
<div class="row">
    <div class="col">
        <div class="card">
            <h4 class="card-header">{{$role->display_name}}</h4>
            <div class="card-body">
                <p class="card-text"><strong>Name: </strong></p>
                <p>{{$role->name}}</p>
                <p><strong>Description:</strong></p>
                <p>
                    {{$role->description}}
                </p>
                <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary btn-block">Edit Role and Permissions</a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card">
            <h4 class="card-header">Permissions:</h4>
            <div class="card-body">
                <ul class="list-unstyled">
                    @foreach ($role->permissions as $item)
                        <li>{{$item->display_name}} <em class="m-l-10">({{$item->description}})</em></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
