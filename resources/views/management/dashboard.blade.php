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
        <div class="col-9">
            <div class="row">
                <div class="col border border-primary">
                    This is some text within a card body.
                </div>
                <div class="col m-l--1 border border-primary">
                    This is some text within a card body.
                </div>
                <div class="col m-l--1 border border-primary">
                    This is some text within a card body.
                </div>
            </div>

        </div>
        <div class="col-3">
            check
        </div>
    </div>
</div>
@endsection
