@extends ('layouts.management')
@section ('content')

<p><a href="{{route('permissions.index')}}"><strong>&larr; Back</strong></a></p>
<div class="card">
    <h4 class="card-header">{{$permission->display_name}}</h4>
    <div class="card-body">
        <p class="card-text"><strong>Slug: </strong></p>
        <p>{{$permission->name}}</p>
        <p><strong>Description:</strong></p>
        <p>{{$permission->description}}</p>
        <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-primary btn-block">Edit Permission</a>
  </div>
</div>

@endsection
