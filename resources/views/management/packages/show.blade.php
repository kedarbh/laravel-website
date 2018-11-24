@extends ('layouts.management')
@section ('content')

<p><a href="{{route('packages.index')}}"><strong>&larr; Back</strong></a></p>
<div class="card">
    <h4 class="card-header">{{$package->title}}</h4>
    <div class="card-body">
        <p class="card-text"><strong>Slug: </strong></p>
        <p>{{$package->slug}}</p>
        <p><strong>Features:</strong></p>
        <p>
            <ol>
                @foreach (json_decode($package->feature) as $item)
                    <li>{{$item}}</li>
                @endforeach
            </ol>
        </p>
        <p><strong>Image:</strong></p>
        <div>
            <img src="/storage/featured_images/{{$package->image}}" width="100%">
        </div>
        <p><strong>Price:</strong></p>
        <p>{{$package->price}}</p>
        <p>status:</p>
        <p>
            @if($package->status === 0)
                Draft
            @elseif($package->status === 1)
                Published
            @endif
        </p>
        <div>
            {!! $package->content !!}
        </div>

        <a href="{{route('packages.edit', $package->id)}}" class="btn btn-primary btn-block">Edit Package</a>
  </div>
</div>

@endsection
