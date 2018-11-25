@extends('layouts.management')
@section('content')
<div class="row m-b-30" >
    <div class="col"><h2>Manage Tour Packages</h2></div>
    <div class="col text-right"><a class="btn btn-success btn-lg" href="{{route('pages.create')}}">Add New Page</a></div>
</div>
<table class="table table-sm table-striped shadow p-3 table-bordered">
    <thead class="bg-secondary text-white">
        <tr>
        <th>S.N.</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Status</th>
        <th>Action</th>
        </tr>
    </thead>
    @foreach($pages as $page)
        <tr>
            <td>{{$page->id}}</td>
            <td>{{$page->title}}</td>
            <td>{{$page->slug}}</td>
            <td>
                @if($page->status === 0)
                    Draft
                @elseif($page->status === 1)
                    Published
                @endif
            </td>
            <td><a class="btn btn-dark btn-sm" href="{{route('pages.show', $page->id)}}">View</a>
            <a class="btn btn-primary btn-sm" href="{{route('pages.edit', $page->id)}}">Edit</a>
            </td>
        </tr>
    @endforeach
</table>

{{-- <div class="d-flex justify-content-center">
    {{$permissions->render()}}
</div> --}}
@endsection
