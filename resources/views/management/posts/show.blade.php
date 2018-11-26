@extends ('layouts.management')
@section ('content')

<p><a href="{{route('posts.index')}}"><strong>&larr; Back</strong></a></p>
<div class="card">
    <h4 class="card-header">Edit {{$post->title}}</h4>
    <div class="card-body">
        <p class="card-text"><strong>Slug: </strong></p>
        <p>{{$post->slug}}</p>
        <p><strong>Status:</strong></p>
        <p>
            @if($post->status === 0)
                Draft
            @elseif($post->status === 1)
                Published
            @endif
        </p>
        <p><strong>Image:</strong></p>
        <div>
            <img src="/storage/post_images/{{$post->image}}" class="img-fluid">
        </div>
        <div>
            <p><strong>Body:</strong></p>
        </div>
        <div class="card card-body">
            {!! $post->body !!}
        </div>


        <div class="row m-t-20">
            <div class="col">
                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary btn-block">Edit Post</a>
            </div>
            <div class="col">
                <form action="{{route('posts.destroy', $post->id)}}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-block">Delete</button>
                </form>
            </div>
        </div>
  </div>
</div>

@endsection
