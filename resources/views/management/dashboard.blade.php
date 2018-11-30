@extends('layouts.management')

@section('content')
<h1>Admin Dashboard</h1>
<hr>

<header class="page-title-bar">
    <p class="lead">
        <span class="font-weight-bold">Hi, {{ Auth::user()->name }}.</span>
        <span class="d-block text-muted">What are you going to do today?</span>
    </p>
</header>

<div class="container m-t-30">
    <div class="row">
        <div class="col">
            <div class="row text-center">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('packages.index')}}" class="text-muted">
                                <h2>Packages</h2>
                                <p>
                                    <i class="fa fa-map-marked-alt"></i>
                                    <span> {{DB::table('packages')->count()}}</span>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('pages.index')}}" class="text-muted">
                                <h2>Packages</h2>
                                <p>
                                    <i class="fa fa-sticky-note"></i>
                                    <span> {{DB::table('pages')->count()}}</span>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('posts.index')}}" class="text-muted">
                                <h2>Packages</h2>
                                <p>
                                    <i class="fa fa-pen-nib"></i>
                                    <span> {{DB::table('posts')->count()}}</span>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">

        </div>
    </div>
</div>
@endsection
