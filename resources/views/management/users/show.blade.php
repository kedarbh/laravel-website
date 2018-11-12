@extends ('layouts.management')
@section ('content')

<p><a href="{{route('users.index')}}"><strong>&larr; Back</strong></a></p>
<div class="card">
    <h4 class="card-header">{{$user->name}}</h4>
    <div class="card-body">
        <p class="card-text"><strong>Email: </strong></p>
        <p>{{$user->email}}</p>
        <p><strong>Role:</strong></p>
        <p>
            @forelse ($user->roles as $role)
                {{$role->display_name}} ({{$role->description}})
            @empty
                This user has not been assigned any roles yet.
            @endforelse
        </p>
        <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-block">Edit User</a>
  </div>
</div>

@endsection