@extends('layouts.management')
@section('content')
<div class="row">
        <div class="col-md-10">
            <h1 class="text-primary">Manage Posts</h1>
        </div>
        <div class="col-md-2">
            <a href="{{Route('posts.create')}}" class="btn btn-block btn-primary btn-h1-spacing">Create New Post</a>
        </div>
        <div class="col-md-12"><hr></div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php $num = 1; ?>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$num++}}</td>
                            <td>{{$post -> title}}</td>
                            <td>{{ substr(strip_tags($post -> body), 0, 50) }}{{strlen($post -> body) > 50 ? "..." : ""}}</td>
                            <td>
                                @if($post->status === 0)
                                    Draft
                                @elseif($post->status === 1)
                                    Published
                                @endif
                            </td>
                            <td>{{date('M j, Y', strtotime($post -> created_at))}}</td>
                            <td>
                                <a class="btn btn-dark btn-sm" href="{{route('posts.show', $post->id)}}">View</a>
                                <a class="btn btn-primary btn-sm" href="{{route('posts.edit', $post->id)}}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            {{-- <div class="text-center">
                {!! $posts -> links() !!}
            </div> --}}
        </div>
    </div>
@endsection
