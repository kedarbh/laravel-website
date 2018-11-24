@extends('layouts.management')
@section('content')
<div class="row m-b-30" >
    <div class="col"><h2>Manage Tour Packages</h2></div>
    <div class="col text-right"><a class="btn btn-success btn-lg" href="{{route('packages.create')}}">Add New Tour Package</a></div>
</div>
<table class="table table-sm table-striped shadow p-3 table-bordered">
    <thead class="bg-secondary text-white">
        <tr>
        <th>S.N.</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
        </tr>
    </thead>
    @foreach($packages as $package)
        <tr>
            <td>{{$package->id}}</td>
            <td>{{$package->title}}</td>
            <td>{{$package->slug}}</td>
            <td>{{$package->price}}</td>
            <td>
                @if($package->status === 0)
                    Draft
                @elseif($package->status === 1)
                    Published
                @endif
            </td>
            <td><a class="btn btn-dark btn-sm" href="{{route('packages.show', $package->id)}}">View</a>
            <a class="btn btn-primary btn-sm" href="{{route('packages.edit', $package->id)}}">Edit</a>
            </td>
        </tr>
    @endforeach
</table>

{{-- <div class="d-flex justify-content-center">
    {{$permissions->render()}}
</div> --}}
@endsection
