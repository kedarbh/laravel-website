<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Website - MANAGEMENT</title>

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body>
        @include('_includes.nav.topnav')

            <!-- Bootstrap row -->
            <div class="row" id="body-row">
                @include('_includes.nav.sidenav')

                <!-- MAIN -->
                <div class="col m-t-50 m-b-30" id="app">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                        @yield('content')
                </div>

                </div>
                <!-- Main Col END -->

            </div>
            <!-- body-row END -->

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        <!-- development version, includes helpful console warnings -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    @yield('scripts')
</body>
</html>
