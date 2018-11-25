@extends ('layouts.management')
@section ('content')

<p><a href="{{route('pages.index')}}"><strong>&larr; Back</strong></a></p>
<div class="card">
    <h4 class="card-header">Edit {{$page->title}}</h4>
    <div class="card-body">
        <p class="card-text"><strong>Slug: </strong></p>
        <p>{{$page->slug}}</p>
        <p><strong>Status:</strong></p>
        <p>
            @if($page->status === 0)
                Draft
            @elseif($page->status === 1)
                Published
            @endif
        </p>
        <div>
            <p><strong>Body:</strong></p>
        </div>
        <div class="card card-body">
            {!! $page->body !!}
        </div>


        <div class="row m-t-20">
            <div class="col">
                <a href="{{route('pages.edit', $page->id)}}" class="btn btn-primary btn-block">Edit Page</a>
            </div>
            <div class="col">
                <form action="{{route('pages.destroy', $page->id)}}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-block">Delete</button>
                </form>
            </div>
        </div>
  </div>
</div>

@endsection
